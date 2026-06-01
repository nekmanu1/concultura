<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar participante
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <form action="{{ route('participantes.update', $participante) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Concurso</label>
                    <select name="concurso_id" class="w-full border-gray-300 rounded" required>
                        @foreach($concursos as $concurso)
                            <option value="{{ $concurso->id }}" {{ old('concurso_id', $participante->concurso_id) == $concurso->id ? 'selected' : '' }}>
                                {{ $concurso->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('concurso_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Nombre del participante</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $participante->nombre) }}"
                           class="w-full border-gray-300 rounded" required>
                    @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Cédula</label>
                    <input type="text" name="cedula" value="{{ old('cedula', $participante->cedula) }}"
                           class="w-full border-gray-300 rounded">
                    @error('cedula') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $participante->telefono) }}"
                           class="w-full border-gray-300 rounded">
                    @error('telefono') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Correo</label>
                    <input type="email" name="correo" value="{{ old('correo', $participante->correo) }}"
                           class="w-full border-gray-300 rounded">
                    @error('correo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Descripción / pieza / observación</label>
                    <textarea name="descripcion"
                              class="w-full border-gray-300 rounded">{{ old('descripcion', $participante->descripcion) }}</textarea>
                    @error('descripcion') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Actualizar
                    </button>

                    <a href="{{ route('participantes.index', ['concurso_id' => $participante->concurso_id]) }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>