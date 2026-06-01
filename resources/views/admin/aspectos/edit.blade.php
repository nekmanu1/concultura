<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar aspecto
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            @if($aspecto->es_general)
                <div class="mb-4 bg-yellow-100 text-yellow-800 p-3 rounded">
                    Este es un aspecto general. Puedes editar su información, pero no se puede eliminar.
                </div>
            @endif

            <form action="{{ route('aspectos.update', $aspecto) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Categoría</label>
                    <select name="categoria_id" class="w-full border-gray-300 rounded" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $aspecto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Nombre del aspecto</label>
                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre', $aspecto->nombre) }}"
                           class="w-full border-gray-300 rounded"
                           required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion', $aspecto->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <select name="estado" class="w-full border-gray-300 rounded" required>
                        <option value="1" {{ old('estado', $aspecto->estado) == '1' ? 'selected' : '' }}>
                            Activo
                        </option>
                        <option value="0" {{ old('estado', $aspecto->estado) == '0' ? 'selected' : '' }}>
                            Inactivo
                        </option>
                    </select>
                    @error('estado') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('aspectos.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>