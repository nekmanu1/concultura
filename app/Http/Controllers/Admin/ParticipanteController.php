<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function index(Request $request)
    {
        $concursoId = $request->get('concurso_id');

        $query = Participante::with('concurso')->latest();

        if ($concursoId) {
            $query->where('concurso_id', $concursoId);
        }

        $participantes = $query->paginate(10);
        $concursos = Concurso::orderBy('nombre')->get();

        return view('admin.participantes.index', compact('participantes', 'concursos', 'concursoId'));
    }

    public function create(Request $request)
    {
        $concursos = Concurso::orderBy('nombre')->get();
        $concursoId = $request->get('concurso_id');

        return view('admin.participantes.create', compact('concursos', 'concursoId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'concurso_id' => ['required', 'exists:concursos,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'cedula' => ['nullable', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'max:100'],
            'correo' => ['nullable', 'email', 'max:255'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $concurso = Concurso::findOrFail($request->concurso_id);

if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'El concurso está cerrado.');
}

        Participante::create($request->only([
            'concurso_id',
            'nombre',
            'cedula',
            'telefono',
            'correo',
            'descripcion',
        ]));

        return redirect()
            ->route('participantes.index', ['concurso_id' => $request->concurso_id])
            ->with('success', 'Participante creado correctamente.');
    }

    public function show(Participante $participante)
    {
        $participante->load('concurso');

        return view('admin.participantes.show', compact('participante'));
    }

    public function edit(Participante $participante)
    {
        $concursos = Concurso::orderBy('nombre')->get();

        return view('admin.participantes.edit', compact('participante', 'concursos'));
    }

    public function update(Request $request, Participante $participante)
    {
        $request->validate([
            'concurso_id' => ['required', 'exists:concursos,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'cedula' => ['nullable', 'string', 'max:100'],
            'telefono' => ['nullable', 'string', 'max:100'],
            'correo' => ['nullable', 'email', 'max:255'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $concurso = Concurso::findOrFail($request->concurso_id);

if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'El concurso está cerrado.');
}

        $participante->update($request->only([
            'concurso_id',
            'nombre',
            'cedula',
            'telefono',
            'correo',
            'descripcion',
        ]));

        return redirect()
            ->route('participantes.index', ['concurso_id' => $request->concurso_id])
            ->with('success', 'Participante actualizado correctamente.');
    }

    public function destroy(Participante $participante)
    {
        $concursoId = $participante->concurso_id;

        if ($participante->concurso->estado === 'CERRADO') {
    return back()->with('error', 'El concurso está cerrado.');
}

        $participante->delete();

        return redirect()
            ->route('participantes.index', ['concurso_id' => $concursoId])
            ->with('success', 'Participante eliminado correctamente.');
    }
}