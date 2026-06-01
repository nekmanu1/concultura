<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Usuarios
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
            <a href="{{ route('usuarios.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Crear usuario
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Correo</th>
                        <th class="p-3 border">Rol</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td class="p-3 border">{{ $usuario->name }}</td>
                            <td class="p-3 border">{{ $usuario->email }}</td>
                            <td class="p-3 border">{{ $usuario->role }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('usuarios.show', $usuario) }}"
                                   class="text-blue-600">
                                    Ver
                                </a>

                                <a href="{{ route('usuarios.edit', $usuario) }}"
                                   class="text-yellow-600 ml-3">
                                    Editar
                                </a>

                                @if(auth()->id() !== $usuario->id)
                                    <form action="{{ route('usuarios.destroy', $usuario) }}"
                                          method="POST"
                                          class="inline ml-3"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $usuarios->links() }}
        </div>
    </div>
</x-app-layout>