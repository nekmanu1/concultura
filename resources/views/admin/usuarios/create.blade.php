<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Crear usuario
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Correo</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Rol</label>
                    <select name="role" class="w-full border-gray-300 rounded" required>
                        <option value="">Seleccione</option>
                        <option value="ADMINISTRADOR" {{ old('role') == 'ADMINISTRADOR' ? 'selected' : '' }}>
                            Administrador
                        </option>
                        <option value="JURADO" {{ old('role') == 'JURADO' ? 'selected' : '' }}>
                            Jurado
                        </option>
                    </select>
                    @error('role') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Contraseña</label>
                    <input type="password" name="password"
                           class="w-full border-gray-300 rounded" required>
                    @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border-gray-300 rounded" required>
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Guardar
                    </button>

                    <a href="{{ route('usuarios.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>