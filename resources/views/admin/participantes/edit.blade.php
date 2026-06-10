<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-pencil-square class="w-7 h-7 text-green-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Editar participante
                </h2>

                <p class="text-sm text-gray-500">
                    Actualizar información del participante
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 text-white">
                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $participante->nombre }}
                        </h1>

                        <p class="text-green-100">
                            {{ $participante->concurso->nombre }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="p-6">

                <form action="{{ route('participantes.update', $participante) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-trophy class="w-5 h-5 text-green-600" />
                                Concurso
                            </label>

                            <select name="concurso_id"
                                    class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                    required>
                                @foreach($concursos as $concurso)
                                    <option value="{{ $concurso->id }}" {{ old('concurso_id', $participante->concurso_id) == $concurso->id ? 'selected' : '' }}>
                                        {{ $concurso->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('concurso_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-user class="w-5 h-5 text-green-600" />
                                Nombre del participante
                            </label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ old('nombre', $participante->nombre) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                   required>

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-identification class="w-5 h-5 text-green-600" />
                                Cédula
                            </label>

                            <input type="text"
                                   name="cedula"
                                   value="{{ old('cedula', $participante->cedula) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('cedula')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-phone class="w-5 h-5 text-green-600" />
                                Teléfono
                            </label>

                            <input type="text"
                                   name="telefono"
                                   value="{{ old('telefono', $participante->telefono) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('telefono')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-envelope class="w-5 h-5 text-green-600" />
                                Correo
                            </label>

                            <input type="email"
                                   name="correo"
                                   value="{{ old('correo', $participante->correo) }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('correo')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-green-600" />
                                Descripción / pieza / observación
                            </label>

                            <textarea name="descripcion"
                                      rows="4"
                                      class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">{{ old('descripcion', $participante->descripcion) }}</textarea>

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="flex gap-3">
                            <x-heroicon-o-information-circle class="w-6 h-6 text-green-600 flex-shrink-0" />

                            <div>
                                <p class="font-semibold text-green-700">
                                    Información
                                </p>

                                <p class="text-sm text-green-600">
                                    Los participantes no tienen acceso al sistema; solo son datos utilizados para la evaluación.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">
                            <x-heroicon-o-check class="w-5 h-5" />
                            Actualizar participante
                        </button>

                        <a href="{{ route('participantes.index', ['concurso_id' => $participante->concurso_id]) }}"
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