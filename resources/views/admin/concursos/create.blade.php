<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-trophy class="w-7 h-7 text-red-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Crear concurso
                </h2>

                <p class="text-sm text-gray-500">
                    Registrar un nuevo concurso de evaluación
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- CABECERA --}}
            <div class="bg-gradient-to-r from-red-700 to-red-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-trophy class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Nuevo Concurso
                        </h1>

                        <p class="text-red-100">
                            Configura la información general del concurso
                        </p>
                    </div>

                </div>

            </div>

            {{-- FORMULARIO --}}
            <div class="p-6">

                <form action="{{ route('concursos.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- CATEGORIA --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-squares-2x2 class="w-5 h-5 text-red-600" />
                                Categoría
                            </label>

                            <select name="categoria_id"
                                    class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500"
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
                                <x-heroicon-o-tag class="w-5 h-5 text-red-600" />
                                Nombre del concurso
                            </label>

                            <input type="text"
                                   name="nombre"
                                   value="{{ old('nombre') }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500"
                                   placeholder="Ej: Concurso Nacional de Artesanías 2026"
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
                                <x-heroicon-o-document-text class="w-5 h-5 text-red-600" />
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- FECHA INICIO --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-calendar-days class="w-5 h-5 text-red-600" />
                                Fecha inicio
                            </label>

                            <input type="date"
                                   name="fecha_inicio"
                                   value="{{ old('fecha_inicio') }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500">

                            @error('fecha_inicio')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- FECHA FIN --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-calendar-days class="w-5 h-5 text-red-600" />
                                Fecha fin
                            </label>

                            <input type="date"
                                   name="fecha_fin"
                                   value="{{ old('fecha_fin') }}"
                                   class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500">

                            @error('fecha_fin')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- ESTADO --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-bolt class="w-5 h-5 text-red-600" />
                                Estado
                            </label>

                            <select name="estado"
                                    class="w-full border-gray-300 rounded-xl focus:border-red-500 focus:ring-red-500"
                                    required>

                                <option value="BORRADOR"
                                    {{ old('estado') == 'BORRADOR' ? 'selected' : '' }}>
                                    Borrador
                                </option>

                                <option value="ACTIVO"
                                    {{ old('estado') == 'ACTIVO' ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="CERRADO"
                                    {{ old('estado') == 'CERRADO' ? 'selected' : '' }}>
                                    Cerrado
                                </option>

                            </select>

                        </div>

                    </div>

                    {{-- INFORMACION --}}
                    <div class="mt-6 bg-red-50 border border-red-200 rounded-xl p-4">

                        <div class="flex gap-3">

                            <x-heroicon-o-information-circle
                                class="w-6 h-6 text-red-600 flex-shrink-0" />

                            <div>

                                <p class="font-semibold text-red-700">
                                    Información importante
                                </p>

                                <p class="text-sm text-red-600">
                                    Una vez creado el concurso podrás asignar
                                    criterios, participantes y jurados para iniciar
                                    el proceso de evaluación.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

                            <x-heroicon-o-check class="w-5 h-5" />
                            Guardar concurso

                        </button>

                        <a href="{{ route('concursos.index') }}"
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