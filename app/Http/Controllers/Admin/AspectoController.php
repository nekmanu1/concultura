<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspecto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AspectoController extends Controller
{
    public function index()
    {
        $aspectos = Aspecto::with('categoria')->latest()->paginate(10);

        return view('admin.aspectos.index', compact('aspectos'));
    }

    public function create()
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.aspectos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('aspectos')->where(function ($query) use ($request) {
                    return $query->where('categoria_id', $request->categoria_id);
                }),
            ],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'boolean'],
        ]);

        Aspecto::create([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'es_general' => false,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('aspectos.index')
            ->with('success', 'Aspecto creado correctamente.');
    }

    public function show(Aspecto $aspecto)
    {
        $aspecto->load('categoria');

        return view('admin.aspectos.show', compact('aspecto'));
    }

    public function edit(Aspecto $aspecto)
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.aspectos.edit', compact('aspecto', 'categorias'));
    }

    public function update(Request $request, Aspecto $aspecto)
    {
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('aspectos')->where(function ($query) use ($request) {
                    return $query->where('categoria_id', $request->categoria_id);
                })->ignore($aspecto->id),
            ],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'boolean'],
        ]);

        $aspecto->update([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('aspectos.index')
            ->with('success', 'Aspecto actualizado correctamente.');
    }

    public function destroy(Aspecto $aspecto)
    {
        if ($aspecto->es_general) {
            return redirect()
                ->route('aspectos.index')
                ->with('error', 'No puedes eliminar el aspecto general de una categoría.');
        }

        $aspecto->delete();

        return redirect()
            ->route('aspectos.index')
            ->with('success', 'Aspecto eliminado correctamente.');
    }
}