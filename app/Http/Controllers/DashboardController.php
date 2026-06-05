<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Aspecto;
use App\Models\Criterio;
use App\Models\Concurso;
use App\Models\Participante;
use App\Models\Evaluacion;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'ADMINISTRADOR') {

            $participantesPorConcurso = Concurso::withCount('participantes')
                ->orderByDesc('participantes_count')
                ->limit(5)
                ->get();

            $evaluacionesPorConcurso = Concurso::withCount('evaluaciones')
                ->orderByDesc('evaluaciones_count')
                ->limit(5)
                ->get();

            return view('dashboard.admin', [
                'totalUsuarios' => User::count(),
                'totalCategorias' => Categoria::count(),
                'totalAspectos' => Aspecto::count(),
                'totalCriterios' => Criterio::count(),
                'totalConcursos' => Concurso::count(),
                'totalParticipantes' => Participante::count(),
                'totalEvaluaciones' => Evaluacion::count(),

                'concursosBorrador' => Concurso::where('estado', 'BORRADOR')->count(),
                'concursosActivos' => Concurso::where('estado', 'ACTIVO')->count(),
                'concursosCerrados' => Concurso::where('estado', 'CERRADO')->count(),

                'participantesPorConcurso' => $participantesPorConcurso,
                'evaluacionesPorConcurso' => $evaluacionesPorConcurso,

                'participantesLabels' => $participantesPorConcurso->pluck('nombre'),
                'participantesData' => $participantesPorConcurso->pluck('participantes_count'),

                'evaluacionesLabels' => $evaluacionesPorConcurso->pluck('nombre'),
                'evaluacionesData' => $evaluacionesPorConcurso->pluck('evaluaciones_count'),

                'ultimosConcursos' => Concurso::with('categoria')
                    ->latest()
                    ->limit(5)
                    ->get(),
            ]);
        }

        if (auth()->user()->role === 'JURADO') {
            return view('dashboard.jurado');
        }

        abort(403);
    }
}