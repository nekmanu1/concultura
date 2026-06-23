<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Concurso;
use Illuminate\Http\Request;
use App\Models\Aspecto;
use App\Models\Criterio;
use App\Models\ConcursoCriterio;
use App\Models\User;
use App\Models\ConcursoJurado;
use App\Models\ConcursoJuradoAspecto;
use App\Helpers\BitacoraHelper;

class ConcursoController extends Controller {

    public function criterios(Concurso $concurso)
    {
    $concurso->load('categoria');

    $criterios = Criterio::where('categoria_id', $concurso->categoria_id)
        ->where('estado', true)
        ->orderBy('nombre')
        ->get();

    $aspectos = Aspecto::where('categoria_id', $concurso->categoria_id)
        ->where('estado', true)
        ->orderBy('es_general', 'desc')
        ->orderBy('nombre')
        ->get();

    $asignados = ConcursoCriterio::with(['criterio', 'aspecto'])
        ->where('concurso_id', $concurso->id)
        ->get();

    $asignadosPorCriterio = $asignados->keyBy('criterio_id');

    return view('admin.concursos.criterios', compact(
        'concurso',
        'criterios',
        'aspectos',
        'asignados',
        'asignadosPorCriterio'
    ));
    }

    public function guardarCriterios(Request $request, Concurso $concurso)
    {
        if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'El concurso está cerrado.');
}
    $request->validate([
        'aspectos' => ['nullable', 'array'],
        'aspectos.*' => ['nullable', 'exists:aspectos,id'],
    ]);
    BitacoraHelper::registrar(
    'ASIGNAR',
    'Criterios',
    'Se actualizaron criterios del concurso ' . $concurso->nombre
);

    ConcursoCriterio::where('concurso_id', $concurso->id)->delete();

    if ($request->filled('aspectos')) {
        foreach ($request->aspectos as $criterioId => $aspectoId) {
            if ($aspectoId) {
                $criterio = Criterio::where('id', $criterioId)
                    ->where('categoria_id', $concurso->categoria_id)
                    ->first();

                $aspecto = Aspecto::where('id', $aspectoId)
                    ->where('categoria_id', $concurso->categoria_id)
                    ->first();

                if ($criterio && $aspecto) {
                    ConcursoCriterio::create([
                        'concurso_id' => $concurso->id,
                        'criterio_id' => $criterio->id,
                        'aspecto_id' => $aspecto->id,
                    ]);
                }
            }
        }
    }

    return redirect()
        ->route('concursos.criterios', $concurso)
        ->with('success', 'Criterios asignados correctamente.');
    }
    public function index()
    {
        $concursos = Concurso::with('categoria')->latest()->paginate(10);

        return view('admin.concursos.index', compact('concursos'));
    }

    public function create()
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.concursos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'estado' => ['required', 'in:BORRADOR,ACTIVO,CERRADO'],
            'permitir_recursos_jurados' => ['nullable', 'boolean'],
        ]);

       $concurso = Concurso::create([
    'categoria_id' => $request->categoria_id,
    'nombre' => $request->nombre,
    'descripcion' => $request->descripcion,
    'fecha_inicio' => $request->fecha_inicio,
    'fecha_fin' => $request->fecha_fin,
    'estado' => $request->estado,
    'permitir_recursos_jurados' => $request->input('permitir_recursos_jurados', 0),
]);
        
        BitacoraHelper::registrar(
    'CREAR',
    'Concursos',
    'Se creó el concurso: ' . $concurso->nombre
);


        return redirect()
            ->route('concursos.index')
            ->with('success', 'Concurso creado correctamente.');
    }

    public function show(Concurso $concurso)
    {
        $concurso->load('categoria');

        return view('admin.concursos.show', compact('concurso'));
    }

    public function edit(Concurso $concurso)
    {
        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();

        return view('admin.concursos.edit', compact('concurso', 'categorias'));
    }

    public function update(Request $request, Concurso $concurso)
    {
        if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'No se puede modificar un concurso cerrado.');
}
        $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'estado' => ['required', 'in:BORRADOR,ACTIVO,CERRADO'],
            'permitir_recursos_jurados' => ['nullable', 'boolean'],
        ]);
$concurso->update([
    'categoria_id' => $request->categoria_id,
    'nombre' => $request->nombre,
    'descripcion' => $request->descripcion,
    'fecha_inicio' => $request->fecha_inicio,
    'fecha_fin' => $request->fecha_fin,
    'estado' => $request->estado,
    'permitir_recursos_jurados' => $request->input('permitir_recursos_jurados', 0),
]);

        BitacoraHelper::registrar(
    'EDITAR',
    'Concursos',
    'Se editó el concurso: ' . $concurso->nombre
);

        return redirect()
            ->route('concursos.index')
            ->with('success', 'Concurso actualizado correctamente.');
    }

    public function destroy(Concurso $concurso)
    {
        if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'No se puede eliminar un concurso cerrado.');
}
        $nombre = $concurso->nombre;

$concurso->delete();

BitacoraHelper::registrar(
    'ELIMINAR',
    'Concursos',
    'Se eliminó el concurso: ' . $nombre
);
        $concurso->delete();

        return redirect()
            ->route('concursos.index')
            ->with('success', 'Concurso eliminado correctamente.');
    }
    public function jurados(Concurso $concurso)
{
    $concurso->load('categoria');

    $jurados = User::where('role', 'JURADO')
        ->orderBy('name')
        ->get();

    $aspectos = Aspecto::where('categoria_id', $concurso->categoria_id)
        ->where('estado', true)
        ->orderBy('es_general', 'desc')
        ->orderBy('nombre')
        ->get();

    $juradosAsignados = ConcursoJurado::where('concurso_id', $concurso->id)
        ->pluck('user_id')
        ->toArray();

    $aspectosAsignados = ConcursoJuradoAspecto::where('concurso_id', $concurso->id)
        ->get()
        ->groupBy('user_id');

    return view('admin.concursos.jurados', compact(
        'concurso',
        'jurados',
        'aspectos',
        'juradosAsignados',
        'aspectosAsignados'
    ));
}

public function guardarJurados(Request $request, Concurso $concurso)
{

     if ($concurso->estado === 'CERRADO') {
    return back()->with('error', 'El concurso está cerrado.');
}
    $request->validate([
        'jurados' => ['nullable', 'array'],
        'jurados.*' => ['exists:users,id'],
        'aspectos' => ['nullable', 'array'],
    ]);

    ConcursoJurado::where('concurso_id', $concurso->id)->delete();
    ConcursoJuradoAspecto::where('concurso_id', $concurso->id)->delete();

    $jurados = $request->jurados ?? [];

    foreach ($jurados as $juradoId) {
        $jurado = User::where('id', $juradoId)
            ->where('role', 'JURADO')
            ->first();

        if (!$jurado) {
            continue;
        }
        BitacoraHelper::registrar(
    'ASIGNAR',
    'Jurados',
    'Se actualizaron jurados del concurso ' . $concurso->nombre
);

        ConcursoJurado::create([
            'concurso_id' => $concurso->id,
            'user_id' => $jurado->id,
        ]);

        $aspectosDelJurado = $request->aspectos[$jurado->id] ?? [];

        foreach ($aspectosDelJurado as $aspectoId) {
            $aspecto = Aspecto::where('id', $aspectoId)
                ->where('categoria_id', $concurso->categoria_id)
                ->first();

            if ($aspecto) {
                ConcursoJuradoAspecto::create([
                    'concurso_id' => $concurso->id,
                    'user_id' => $jurado->id,
                    'aspecto_id' => $aspecto->id,
                ]);
            }
        }
    }

    return redirect()
        ->route('concursos.jurados', $concurso)
        ->with('success', 'Jurados asignados correctamente.');
}
public function cerrar(Concurso $concurso)
{
    $concurso->update([
        'estado' => 'CERRADO'
    ]);

    BitacoraHelper::registrar(
        'CERRAR',
        'Concursos',
        'Se cerró el concurso: ' . $concurso->nombre
    );

    return redirect()
        ->route('concursos.show', $concurso)
        ->with('success', 'Concurso cerrado correctamente.');
}
}