<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <x-heroicon-o-users class="w-7 h-7 text-blue-600" />

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Usuarios
                    </h2>

                    <p class="text-sm text-gray-500">
                        Administración de usuarios del sistema
                    </p>
                </div>
            </div>

            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $usuarios->total() }} usuarios
            </span>

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-200 text-red-700 p-4 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        {{-- CABECERA --}}
        <div class="bg-white rounded-2xl shadow mb-6 p-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <form method="GET" class="flex-1">
                    <div class="relative">

                        <x-heroicon-o-magnifying-glass
                            class="w-5 h-5 text-gray-400 absolute left-3 top-3" />

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar usuario..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>
                </form>

                <a href="{{ route('usuarios.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                    <x-heroicon-o-plus class="w-5 h-5" />

                    Crear usuario
                </a>

            </div>

        </div>

        {{-- TABLA --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Usuario
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Correo
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Rol
                        </th>

                        <th class="p-4 text-center font-semibold text-gray-700">
                            Acciones
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($usuarios as $usuario)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                                        <x-heroicon-o-user
                                            class="w-5 h-5 text-blue-600" />

                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $usuario->name }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ID: {{ $usuario->id }}
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="p-4 text-gray-600">
                                {{ $usuario->email }}
                            </td>

                            <td class="p-4">

                                @if($usuario->role === 'ADMINISTRADOR')

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Administrador
                                    </span>

                                @else

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Jurado
                                    </span>

                                @endif

                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('usuarios.show', $usuario) }}"
                                       class="inline-flex items-center gap-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg">

                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>

                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                       class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-lg">

                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </a>

                                    @if(auth()->id() !== $usuario->id)

                                        <form action="{{ route('usuarios.destroy', $usuario) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg">

                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">

                                <x-heroicon-o-users
                                    class="w-10 h-10 mx-auto mb-3 text-gray-300" />

                                No hay usuarios registrados.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $usuarios->links() }}
        </div>

    </div>

</x-app-layout>