<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Crear categoría
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Nombre</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre') }}"
                           class="w-full border-gray-300 rounded"
                           required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <select name="estado" class="w-full border-gray-300 rounded" required>
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activa</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    <x-heroicon-o-check class="w-5 h-5" />
                        Guardar
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