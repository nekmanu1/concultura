<?php

namespace App\Http\Controllers\Jurado;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\ConcursoJurado;
use App\Models\ConcursoJuradoAspecto;
use App\Models\ConcursoCriterio;
use App\Models\Evaluacion;
use App\Models\Participante;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function concursos()
    {
        $concursos = auth()->user()
            ->concursosComoJurado()
            ->with('categoria')
            ->latest()
            ->paginate(10);

        return view('jurado.concursos.index', compact('concursos'));
    }

    public function calificar(Concurso $concurso)
    {
        $this->validarJuradoAsignado($concurso);
        if ($concurso->estado === 'CERRADO') {
        return redirect()
        ->route('jurado.concursos.index')
        ->with('error', 'Este concurso ya fue cerrado.');
        }

        $aspectoIds = ConcursoJuradoAspecto::where('concurso_id', $concurso->id)
            ->where('user_id', auth()->id())
            ->pluck('aspecto_id');

        $concursoCriterios = ConcursoCriterio::with(['criterio', 'aspecto'])
            ->where('concurso_id', $concurso->id)
            ->whereIn('aspecto_id', $aspectoIds)
            ->get()
            ->groupBy('aspecto_id');

        $participantes = Participante::where('concurso_id', $concurso->id)
            ->orderBy('nombre')
            ->get();

        $evaluaciones = Evaluacion::where('concurso_id', $concurso->id)
            ->where('jurado_id', auth()->id())
            ->get()
            ->keyBy(function ($item) {
                return $item->participante_id . '-' . $item->criterio_id;
            });

        return view('jurado.concursos.calificar', compact(
            'concurso',
            'concursoCriterios',
            'participantes',
            'evaluaciones'
        ));
    }

    public function guardar(Request $request, Concurso $concurso)
    {
        $this->validarJuradoAsignado($concurso);
        if ($concurso->estado === 'CERRADO') {
    return redirect()
        ->route('jurado.concursos.index')
        ->with('error', 'Este concurso ya fue cerrado.');
}
        $request->validate([
            'puntajes' => ['nullable', 'array'],
            'observaciones' => ['nullable', 'array'],
        ]);

        $aspectoIdsPermitidos = ConcursoJuradoAspecto::where('concurso_id', $concurso->id)
            ->where('user_id', auth()->id())
            ->pluck('aspecto_id')
            ->toArray();

        foreach (($request->puntajes ?? []) as $participanteId => $criterios) {
            $participante = Participante::where('id', $participanteId)
                ->where('concurso_id', $concurso->id)
                ->first();

            if (!$participante) {
                continue;
            }

            foreach ($criterios as $criterioId => $puntaje) {
                $concursoCriterio = ConcursoCriterio::with('criterio')
                    ->where('concurso_id', $concurso->id)
                    ->where('criterio_id', $criterioId)
                    ->whereIn('aspecto_id', $aspectoIdsPermitidos)
                    ->first();

                if (!$concursoCriterio) {
                    continue;
                }

                $puntajeMaximo = $concursoCriterio->criterio->puntaje_maximo;

                $puntaje = is_numeric($puntaje) ? floatval($puntaje) : 0;

                if ($puntaje < 0) {
                    $puntaje = 0;
                }

                if ($puntaje > $puntajeMaximo) {
                    $puntaje = $puntajeMaximo;
                }

                $observacion = $request->observaciones[$participanteId][$criterioId] ?? null;

                Evaluacion::updateOrCreate(
                    [
                        'concurso_id' => $concurso->id,
                        'participante_id' => $participante->id,
                        'jurado_id' => auth()->id(),
                        'criterio_id' => $criterioId,
                    ],
                    [
                        'aspecto_id' => $concursoCriterio->aspecto_id,
                        'puntaje' => $puntaje,
                        'observacion' => $observacion,
                    ]
                );
            }
        }

        return redirect()
            ->route('jurado.concursos.calificar', $concurso)
            ->with('success', 'Calificación guardada correctamente.');
    }

    private function validarJuradoAsignado(Concurso $concurso): void
    {
        $asignado = ConcursoJurado::where('concurso_id', $concurso->id)
            ->where('user_id', auth()->id())
            ->exists();

        if (!$asignado) {
            abort(403, 'No estás asignado a este concurso.');
        }
    }
}