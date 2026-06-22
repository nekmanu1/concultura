<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-pencil-square class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Editar usuario
                </h2>

                <p class="text-sm text-gray-500">
                    Actualizar información del usuario
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user class="w-8 h-8 text-white" />
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

                <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-user class="w-5 h-5 text-blue-600" />
                                Nombre
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $usuario->name) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                                   required>

                            @error('name')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mb-4">
    <label class="block mb-1">Usuario</label>

    <input
        type="text"
        name="username"
        value="{{ old('username', $usuario->username) }}"
        class="w-full border-gray-300 rounded"
        required>

    @error('username')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
</div>

                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-envelope class="w-5 h-5 text-blue-600" />
                                Correo
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $usuario->email) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                                   required>

                            @error('email')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-shield-check class="w-5 h-5 text-blue-600" />
                                Rol
                            </label>

                            <select name="role"
                                    class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                                    required>

                                <option value="ADMINISTRADOR" {{ old('role', $usuario->role) == 'ADMINISTRADOR' ? 'selected' : '' }}>
                                    Administrador
                                </option>

                                <option value="JURADO" {{ old('role', $usuario->role) == 'JURADO' ? 'selected' : '' }}>
                                    Jurado
                                </option>

                            </select>

                            @error('role')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                    <div class="mt-8 border-t pt-6">

                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">

                            <div class="flex gap-3">

                                <x-heroicon-o-information-circle
                                    class="w-6 h-6 text-blue-600 flex-shrink-0" />

                                <div>

                                    <p class="font-semibold text-blue-700">
                                        Cambio de contraseña
                                    </p>

                                    <p class="text-sm text-blue-600">
                                        Deja los campos de contraseña vacíos si no deseas cambiarla.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>

                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                    <x-heroicon-o-lock-closed class="w-5 h-5 text-blue-600" />
                                    Nueva contraseña
                                </label>

                                <input type="password"
                                       name="password"
                                       class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">

                                @error('password')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            <div>

                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                    <x-heroicon-o-key class="w-5 h-5 text-blue-600" />
                                    Confirmar nueva contraseña
                                </label>

                                <input type="password"
                                       name="password_confirmation"
                                       class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500">

                            </div>

                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                            <x-heroicon-o-check class="w-5 h-5" />
                            Actualizar usuario

                        </button>

                        <a href="{{ route('usuarios.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">

                            <x-heroicon-o-arrow-left class="w-5 h-5" />
                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>