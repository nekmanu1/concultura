<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar usuario
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Correo</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Rol</label>
                    <select name="role" class="w-full border-gray-300 rounded" required>
                        <option value="ADMINISTRADOR" {{ old('role', $usuario->role) == 'ADMINISTRADOR' ? 'selected' : '' }}>
                            Administrador
                        </option>
                        <option value="JURADO" {{ old('role', $usuario->role) == 'JURADO' ? 'selected' : '' }}>
                            Jurado
                        </option>
                    </select>
                    @error('role') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <hr class="my-4">

                <p class="text-sm text-gray-600 mb-3">
                    Deja la contraseña vacía si no deseas cambiarla.
                </p>

                <div class="mb-4">
                    <label class="block mb-1">Nueva contraseña</label>
                    <input type="password" name="password"
                           class="w-full border-gray-300 rounded">
                    @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border-gray-300 rounded">
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('usuarios.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
    <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>