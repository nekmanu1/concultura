<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Criterio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CriterioController extends Controller
{
    public function index()
    {
        $criterios = Criterio::with('categoria')->latest()->paginate(10);

        return view('admin.criterios.index', compact('criterios'));
    }

    public function create()
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.criterios.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('criterios')->where(function ($query) use ($request) {
                    return $query->where('categoria_id', $request->categoria_id);
                }),
            ],
            'descripcion' => ['nullable', 'string'],
            'puntaje_maximo' => ['required', 'numeric', 'min:1'],
            'estado' => ['required', 'boolean'],
        ]);

        Criterio::create([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'puntaje_maximo' => $request->puntaje_maximo,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('criterios.index')
            ->with('success', 'Criterio creado correctamente.');
    }

    public function show(Criterio $criterio)
    {
        $criterio->load('categoria');

        return view('admin.criterios.show', compact('criterio'));
    }

    public function edit(Criterio $criterio)
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.criterios.edit', compact('criterio', 'categorias'));
    }

    public function update(Request $request, Criterio $criterio)
    {
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('criterios')->where(function ($query) use ($request) {
                    return $query->where('categoria_id', $request->categoria_id);
                })->ignore($criterio->id),
            ],
            'descripcion' => ['nullable', 'string'],
            'puntaje_maximo' => ['required', 'numeric', 'min:1'],
            'estado' => ['required', 'boolean'],
        ]);

        $criterio->update([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'puntaje_maximo' => $request->puntaje_maximo,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('criterios.index')
            ->with('success', 'Criterio actualizado correctamente.');
    }

    public function destroy(Criterio $criterio)
    {
        $criterio->delete();

        return redirect()
            ->route('criterios.index')
            ->with('success', 'Criterio eliminado correctamente.');
    }
}