<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver aspecto
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3">
                <strong>Nombre:</strong> {{ $aspecto->nombre }}
            </p>

            <p class="mb-3">
                <strong>Categoría:</strong> {{ $aspecto->categoria->nombre }}
            </p>

            <p class="mb-3">
                <strong>Descripción:</strong> {{ $aspecto->descripcion ?? 'Sin descripción' }}
            </p>

            <p class="mb-3">
                <strong>General:</strong> {{ $aspecto->es_general ? 'Sí' : 'No' }}
            </p>

            <p class="mb-3">
                <strong>Estado:</strong> {{ $aspecto->estado ? 'Activo' : 'Inactivo' }}
            </p>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('aspectos.edit', $aspecto) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('aspectos.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>