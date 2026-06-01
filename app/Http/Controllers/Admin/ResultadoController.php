<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\Evaluacion;
use Illuminate\Support\Facades\DB;

class ResultadoController extends Controller
{
    public function index(Concurso $concurso)
    {
        $concurso->load('categoria');

        $resultados = Evaluacion::select(
                'participantes.id',
                'participantes.nombre',
                'participantes.cedula',
                DB::raw('SUM(evaluacions.puntaje) as total')
            )
            ->join('participantes', 'participantes.id', '=', 'evaluacions.participante_id')
            ->where('evaluacions.concurso_id', $concurso->id)
            ->groupBy('participantes.id', 'participantes.nombre', 'participantes.cedula')
            ->orderByDesc('total')
            ->get();

        $desglose = Evaluacion::with([
                'participante',
                'jurado',
                'aspecto',
                'criterio',
            ])
            ->where('concurso_id', $concurso->id)
            ->orderBy('participante_id')
            ->orderBy('aspecto_id')
            ->orderBy('criterio_id')
            ->get();

        return view('admin.resultados.index', compact(
            'concurso',
            'resultados',
            'desglose'
        ));
    }

    public function exportarResumen(Concurso $concurso)
    {
        $resultados = Evaluacion::select(
                'participantes.id',
                'participantes.nombre',
                'participantes.cedula',
                DB::raw('SUM(evaluacions.puntaje) as total')
            )
            ->join('participantes', 'participantes.id', '=', 'evaluacions.participante_id')
            ->where('evaluacions.concurso_id', $concurso->id)
            ->groupBy('participantes.id', 'participantes.nombre', 'participantes.cedula')
            ->orderByDesc('total')
            ->get();

        $fileName = 'resumen_resultados_concurso_' . $concurso->id . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return response()->stream(function () use ($resultados) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, [
                'Posición',
                'Participante',
                'Cédula',
                'Puntaje total',
            ], ';');

            foreach ($resultados as $index => $resultado) {
                fputcsv($handle, [
                    $index + 1,
                    $resultado->nombre,
                    $resultado->cedula ?? 'No registrada',
                    number_format($resultado->total, 2, '.', ''),
                ], ';');
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function exportarDesglose(Concurso $concurso)
    {
        $desglose = Evaluacion::with([
                'participante',
                'jurado',
                'aspecto',
                'criterio',
            ])
            ->where('concurso_id', $concurso->id)
            ->orderBy('participante_id')
            ->orderBy('aspecto_id')
            ->orderBy('criterio_id')
            ->get();

        $fileName = 'desglose_votacion_concurso_' . $concurso->id . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return response()->stream(function () use ($desglose) {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, [
                'Participante',
                'Cédula',
                'Jurado',
                'Aspecto',
                'Criterio',
                'Puntaje',
                'Observación',
                'Fecha de evaluación',
            ], ';');

            foreach ($desglose as $item) {
                fputcsv($handle, [
                    $item->participante->nombre,
                    $item->participante->cedula ?? 'No registrada',
                    $item->jurado->name,
                    $item->aspecto->nombre,
                    $item->criterio->nombre,
                    number_format($item->puntaje, 2, '.', ''),
                    $item->observacion ?? '',
                    $item->created_at?->format('d/m/Y H:i'),
                ], ';');
            }

            fclose($handle);
        }, 200, $headers);
    }
}