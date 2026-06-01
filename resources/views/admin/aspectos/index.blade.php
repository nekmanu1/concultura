<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Aspectos
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('aspectos.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Crear aspecto
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Categoría</th>
                        <th class="p-3 border">General</th>
                        <th class="p-3 border">Estado</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspectos as $aspecto)
                        <tr>
                            <td class="p-3 border">{{ $aspecto->nombre }}</td>
                            <td class="p-3 border">{{ $aspecto->categoria->nombre }}</td>
                            <td class="p-3 border">{{ $aspecto->es_general ? 'Sí' : 'No' }}</td>
                            <td class="p-3 border">{{ $aspecto->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('aspectos.show', $aspecto) }}"
                                   class="text-blue-600">
                                    Ver
                                </a>

                                <a href="{{ route('aspectos.edit', $aspecto) }}"
                                   class="text-yellow-600 ml-3">
                                    Editar
                                </a>

                                @if(!$aspecto->es_general)
                                    <form action="{{ route('aspectos.destroy', $aspecto) }}"
                                          method="POST"
                                          class="inline ml-3"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este aspecto?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 ml-3">
                                        No eliminable
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center">
                                No hay aspectos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $aspectos->links() }}
        </div>
    </div>
</x-app-layout>