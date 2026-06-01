<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver categoría
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3">
                <strong>Nombre:</strong> {{ $categoria->nombre }}
            </p>

            <p class="mb-3">
                <strong>Descripción:</strong> {{ $categoria->descripcion ?? 'Sin descripción' }}
            </p>

            <p class="mb-3">
                <strong>Estado:</strong> {{ $categoria->estado ? 'Activa' : 'Inactiva' }}
            </p>

            <hr class="my-4">

            <h3 class="text-lg font-bold mb-3">
                Aspectos de esta categoría
            </h3>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">General</th>
                        <th class="p-3 border">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categoria->aspectos as $aspecto)
                        <tr>
                            <td class="p-3 border">{{ $aspecto->nombre }}</td>
                            <td class="p-3 border">{{ $aspecto->es_general ? 'Sí' : 'No' }}</td>
                            <td class="p-3 border">{{ $aspecto->estado ? 'Activo' : 'Inactivo' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-3 text-center">
                                No hay aspectos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('categorias.edit', $categoria) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('categorias.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>