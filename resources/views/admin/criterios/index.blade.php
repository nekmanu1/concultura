<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Criterios
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('criterios.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    <x-heroicon-o-plus class="w-5 h-5" />
                Crear criterio
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Categoría</th>
                        <th class="p-3 border">Puntaje máximo</th>
                        <th class="p-3 border">Estado</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($criterios as $criterio)
                        <tr>
                            <td class="p-3 border">{{ $criterio->nombre }}</td>
                            <td class="p-3 border">{{ $criterio->categoria->nombre }}</td>
                            <td class="p-3 border">{{ $criterio->puntaje_maximo }}</td>
                            <td class="p-3 border">{{ $criterio->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('criterios.show', $criterio) }}"
                                     class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800">
    <x-heroicon-o-eye class="w-4 h-4" />
                                    Ver
                                </a>

                                <a href="{{ route('criterios.edit', $criterio) }}"
                                   class="inline-flex items-center gap-1 text-yellow-600 hover:text-yellow-800 ml-3">
    <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    Editar
                                </a>

                                <form action="{{ route('criterios.destroy', $criterio) }}"
                                      method="POST"
                                      class="inline ml-3"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este criterio?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"   class="inline-flex items-center gap-1 text-red-600 hover:text-red-800">
    <x-heroicon-o-trash class="w-4 h-4" />
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center">
                                No hay criterios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $criterios->links() }}
        </div>
    </div>
</x-app-layout>