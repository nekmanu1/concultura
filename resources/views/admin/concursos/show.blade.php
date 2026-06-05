<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver concurso
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3">
                <strong>Nombre:</strong> {{ $concurso->nombre }}
            </p>

            <p class="mb-3">
                <strong>Categoría:</strong> {{ $concurso->categoria->nombre }}
            </p>

            <p class="mb-3">
                <strong>Descripción:</strong> {{ $concurso->descripcion ?? 'Sin descripción' }}
            </p>

            <p class="mb-3">
                <strong>Fecha inicio:</strong> {{ $concurso->fecha_inicio ?? 'No definida' }}
            </p>

            <p class="mb-3">
                <strong>Fecha fin:</strong> {{ $concurso->fecha_fin ?? 'No definida' }}
            </p>

            <p class="mb-3">
                <strong>Estado:</strong> {{ $concurso->estado }}
            </p>

            @if($concurso->estado !== 'CERRADO')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6">
                <a href="{{ route('concursos.criterios', $concurso) }}"
                   class="bg-purple-600 text-white px-4 py-3 rounded text-center">
                    Asignar criterios a aspectos
                </a>

                <a href="{{ route('participantes.index', ['concurso_id' => $concurso->id]) }}"
                   class="bg-green-600 text-white px-4 py-3 rounded text-center">
                    Participantes
                </a>

                <a href="{{ route('concursos.jurados', $concurso) }}"
                   class="bg-blue-600 text-white px-4 py-3 rounded text-center">
                    Asignar jurados
                </a>
                @endif
                @if($concurso->estado === 'CERRADO')

<div class="bg-red-100 text-red-700 p-4 rounded mt-4">
    Este concurso está cerrado.
    Solo se permiten consultas y resultados.
</div>

@endif

                <a href="{{ route('concursos.resultados', $concurso) }}"
                   class="bg-gray-700 text-white px-4 py-3 rounded text-center">
                   Resultados
                </a>
            </div>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('concursos.edit', $concurso) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('concursos.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Volver
                </a>
            </div>
@if($concurso->estado !== 'CERRADO')

<form action="{{ route('concursos.cerrar', $concurso) }}"
      method="POST"
      class="mt-4"
      onsubmit="return confirm('¿Deseas cerrar este concurso? Después los jurados no podrán seguir calificando.')">

    @csrf

    <button class="bg-red-700 text-white px-4 py-2 rounded">
        Cerrar concurso
    </button>

</form>

@endif
        </div>
    </div>
</x-app-layout>