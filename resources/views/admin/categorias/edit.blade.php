<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar categoría
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Nombre</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $categoria->nombre) }}"
                           class="w-full border-gray-300 rounded"
                           required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <select name="estado" class="w-full border-gray-300 rounded" required>
                        <option value="1" {{ old('estado', $categoria->estado) == '1' ? 'selected' : '' }}>
                            Activa
                        </option>
                        <option value="0" {{ old('estado', $categoria->estado) == '0' ? 'selected' : '' }}>
                            Inactiva
                        </option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('categorias.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>