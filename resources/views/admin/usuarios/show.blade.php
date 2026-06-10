<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-user-circle class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ver usuario
                </h2>
                <p class="text-sm text-gray-500">
                    Información detallada del usuario
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">
                <div class="flex items-center gap-4">

                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user class="w-10 h-10 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $usuario->name }}
                        </h1>

                        <p class="text-blue-100">
                            {{ $usuario->email }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

                    <div class="bg-gray-50 border rounded-xl p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-identification class="w-5 h-5" />
                            Nombre
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $usuario->name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                            Correo
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $usuario->email }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-shield-check class="w-5 h-5" />
                            Rol
                        </div>

                        @if($usuario->role === 'ADMINISTRADOR')
                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-lock-closed class="w-4 h-4" />
                                Administrador
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-clipboard-document-check class="w-4 h-4" />
                                Jurado
                            </span>
                        @endif
                    </div>

                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 border-t pt-6">

                    <div class="flex flex-wrap gap-2">

                        <a href="{{ route('usuarios.edit', $usuario) }}"
                           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                            Editar usuario
                        </a>

                        <a href="{{ route('usuarios.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            <x-heroicon-o-arrow-left class="w-5 h-5" />
                            Volver
                        </a>

                    </div>

                    @if(auth()->id() !== $usuario->id)
                        <form action="{{ route('usuarios.destroy', $usuario) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">

                            @csrf
                            @method('DELETE')

                            <button class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                <x-heroicon-o-trash class="w-5 h-5" />
                                Eliminar
                            </button>

                        </form>
                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>