<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar criterio
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('criterios.update', $criterio) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Categoría</label>
                    <select name="categoria_id" class="w-full border-gray-300 rounded" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $criterio->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Nombre del criterio</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $criterio->nombre) }}"
                           class="w-full border-gray-300 rounded"
                           required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion', $criterio->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Puntaje máximo</label>
                    <input type="number"
                           step="0.01"
                           min="1"
                           name="puntaje_maximo"
                           value="{{ old('puntaje_maximo', $criterio->puntaje_maximo) }}"
                           class="w-full border-gray-300 rounded"
                           required>
                    @error('puntaje_maximo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <select name="estado" class="w-full border-gray-300 rounded" required>
                        <option value="1" {{ old('estado', $criterio->estado) == '1' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="0" {{ old('estado', $criterio->estado) == '0' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                    @error('estado') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('criterios.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
    <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>