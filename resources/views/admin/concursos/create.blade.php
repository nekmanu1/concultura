<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Crear concurso
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('concursos.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Categoría</label>
                    <select name="categoria_id" class="w-full border-gray-300 rounded" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Nombre del concurso</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block mb-1">Fecha inicio</label>
                        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                               class="w-full border-gray-300 rounded">
                        @error('fecha_inicio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Fecha fin</label>
                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                               class="w-full border-gray-300 rounded">
                        @error('fecha_fin') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <select name="estado" class="w-full border-gray-300 rounded" required>
                        <option value="BORRADOR" {{ old('estado') == 'BORRADOR' ? 'selected' : '' }}>Borrador</option>
                        <option value="ACTIVO" {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                        <option value="CERRADO" {{ old('estado') == 'CERRADO' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                    @error('estado') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Guardar
                    </button>

                    <a href="{{ route('concursos.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>