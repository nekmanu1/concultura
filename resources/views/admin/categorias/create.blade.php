<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-squares-2x2 class="w-7 h-7 text-green-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Crear categoría
                </h2>

                <p class="text-sm text-gray-500">
                    Registrar una nueva categoría para los concursos
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- CABECERA --}}
            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-plus class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Nueva Categoría
                        </h1>

                        <p class="text-green-100">
                            Las categorías agrupan concursos, aspectos y criterios
                        </p>
                    </div>

                </div>

            </div>

            {{-- FORMULARIO --}}
            <div class="p-6">

                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- NOMBRE --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-tag class="w-5 h-5 text-green-600" />
                                Nombre
                            </label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ old('nombre') }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                   placeholder="Ej: Dirección de Artesanías"
                                   required>

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- DESCRIPCIÓN --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-green-600" />
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                placeholder="Descripción opcional de la categoría">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- ESTADO --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-bolt class="w-5 h-5 text-green-600" />
                                Estado
                            </label>

                            <select
                                name="estado"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                required>

                                <option value="1"
                                    {{ old('estado', '1') == '1' ? 'selected' : '' }}>
                                    Activa
                                </option>

                                <option value="0"
                                    {{ old('estado') == '0' ? 'selected' : '' }}>
                                    Inactiva
                                </option>

                            </select>

                        </div>

                    </div>

                    {{-- INFORMACIÓN --}}
                    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4">

                        <div class="flex gap-3">

                            <x-heroicon-o-information-circle
                                class="w-6 h-6 text-green-600 flex-shrink-0" />

                            <div>

                                <p class="font-semibold text-green-700">
                                    Información importante
                                </p>

                                <p class="text-sm text-green-600">
                                    Al crear una categoría, el sistema generará automáticamente
                                    un aspecto general asociado a ella. Este aspecto no podrá
                                    eliminarse posteriormente.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                            <x-heroicon-o-check class="w-5 h-5" />
                            Guardar categoría

                        </button>

                        <a href="{{ route('categorias.index') }}"
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