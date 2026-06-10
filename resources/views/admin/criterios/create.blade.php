<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-list-bullet class="w-7 h-7 text-amber-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Crear criterio
                </h2>

                <p class="text-sm text-gray-500">
                    Registrar un nuevo criterio de evaluación
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-amber-600 to-yellow-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-list-bullet class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Nuevo criterio
                        </h1>

                        <p class="text-amber-100">
                            Define los criterios que utilizarán los jurados
                        </p>
                    </div>

                </div>

            </div>

            <div class="p-6">

                <form action="{{ route('criterios.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- CATEGORIA --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-squares-2x2 class="w-5 h-5 text-amber-600" />
                                Categoría
                            </label>

                            <select
                                name="categoria_id"
                                class="w-full border-gray-300 rounded-xl focus:border-amber-500 focus:ring-amber-500"
                                required>

                                <option value="">
                                    Seleccione una categoría
                                </option>

                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach

                            </select>

                            @error('categoria_id')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- NOMBRE --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-tag class="w-5 h-5 text-amber-600" />
                                Nombre del criterio
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                class="w-full border-gray-300 rounded-xl focus:border-amber-500 focus:ring-amber-500"
                                placeholder="Ej: Creatividad, Originalidad, Acabado..."
                                required>

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- DESCRIPCION --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-amber-600" />
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="w-full border-gray-300 rounded-xl focus:border-amber-500 focus:ring-amber-500">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- PUNTAJE --}}
                        <div class="md:col-span-2">

                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">

                                <label class="flex items-center gap-2 text-sm font-semibold text-amber-700 mb-2">
                                    <x-heroicon-o-star class="w-5 h-5" />
                                    Puntaje máximo
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="1"
                                    name="puntaje_maximo"
                                    value="{{ old('puntaje_maximo', 100) }}"
                                    class="w-full border-amber-300 rounded-xl focus:border-amber-500 focus:ring-amber-500"
                                    required>

                                @error('puntaje_maximo')
                                    <p class="text-red-600 text-sm mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                        {{-- ESTADO --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-bolt class="w-5 h-5 text-amber-600" />
                                Estado
                            </label>

                            <select
                                name="estado"
                                class="w-full border-gray-300 rounded-xl focus:border-amber-500 focus:ring-amber-500"
                                required>

                                <option value="1" {{ old('estado','1') == '1' ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>
                                    Inactivo
                                </option>

                            </select>

                            @error('estado')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                    <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4">

                        <div class="flex gap-3">

                            <x-heroicon-o-information-circle
                                class="w-6 h-6 text-amber-600 flex-shrink-0" />

                            <div>

                                <p class="font-semibold text-amber-700">
                                    Información
                                </p>

                                <p class="text-sm text-amber-600">
                                    El puntaje máximo define la calificación más alta
                                    que podrá asignar un jurado a este criterio.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-5 py-3 rounded-xl shadow">

                            <x-heroicon-o-check class="w-5 h-5" />
                            Guardar criterio

                        </button>

                        <a href="{{ route('criterios.index') }}"
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