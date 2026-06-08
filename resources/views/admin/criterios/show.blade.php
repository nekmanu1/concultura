<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver criterio
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3">
                <strong>Nombre:</strong> {{ $criterio->nombre }}
            </p>

            <p class="mb-3">
                <strong>Categoría:</strong> {{ $criterio->categoria->nombre }}
            </p>

            <p class="mb-3">
                <strong>Descripción:</strong> {{ $criterio->descripcion ?? 'Sin descripción' }}
            </p>

            <p class="mb-3">
                <strong>Puntaje máximo:</strong> {{ $criterio->puntaje_maximo }}
            </p>

            <p class="mb-3">
                <strong>Estado:</strong> {{ $criterio->estado ? 'Activo' : 'Inactivo' }}
            </p>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('criterios.edit', $criterio) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('criterios.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
    <x-heroicon-o-arrow-left class="w-5 h-5" />
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>