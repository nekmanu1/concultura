<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-user-group class="w-7 h-7 text-green-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Crear participante
                </h2>

                <p class="text-sm text-gray-500">
                    Registrar un participante en un concurso
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- CABECERA --}}
            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user-group class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Nuevo Participante
                        </h1>

                        <p class="text-green-100">
                            Registro de concursantes para evaluación
                        </p>
                    </div>

                </div>

            </div>

            {{-- FORMULARIO --}}
            <div class="p-6">

                <form action="{{ route('participantes.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- CONCURSO --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-trophy class="w-5 h-5 text-green-600" />
                                Concurso
                            </label>

                            <select
                                name="concurso_id"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                required>

                                <option value="">
                                    Seleccione un concurso
                                </option>

                                @foreach($concursos as $concurso)
                                    <option value="{{ $concurso->id }}"
                                        {{ old('concurso_id', $concursoId) == $concurso->id ? 'selected' : '' }}>
                                        {{ $concurso->nombre }}
                                    </option>
                                @endforeach

                            </select>

                            @error('concurso_id')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- NOMBRE --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-user class="w-5 h-5 text-green-600" />
                                Nombre del participante
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                value="{{ old('nombre') }}"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                                required>

                            @error('nombre')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- CEDULA --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-identification class="w-5 h-5 text-green-600" />
                                Cédula
                            </label>

                            <input
                                type="text"
                                name="cedula"
                                value="{{ old('cedula') }}"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('cedula')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- TELEFONO --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-phone class="w-5 h-5 text-green-600" />
                                Teléfono
                            </label>

                            <input
                                type="text"
                                name="telefono"
                                value="{{ old('telefono') }}"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('telefono')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- CORREO --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-envelope class="w-5 h-5 text-green-600" />
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                name="correo"
                                value="{{ old('correo') }}"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">

                            @error('correo')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- DESCRIPCION --}}
                        <div class="md:col-span-2">

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <x-heroicon-o-document-text class="w-5 h-5 text-green-600" />
                                Descripción / Pieza / Observación
                            </label>

                            <textarea
                                name="descripcion"
                                rows="4"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="md:col-span-2">
    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
        <div class="flex items-center gap-2 mb-4">
            <x-heroicon-o-link class="w-5 h-5 text-green-600" />
            <h3 class="font-semibold text-green-700">
                Recursos
            </h3>
        </div>

        <div class="space-y-3">
            @for($i = 0; $i < 3; $i++)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <input type="text"
                           name="recursos[{{ $i }}][titulo]"
                           value="{{ old('recursos.' . $i . '.titulo', $participante->recursos[$i]->titulo ?? '') }}"
                           class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                           placeholder="Título del recurso">

                    <input type="url"
                           name="recursos[{{ $i }}][url]"
                           value="{{ old('recursos.' . $i . '.url', $participante->recursos[$i]->url ?? '') }}"
                           class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500"
                           placeholder="https://ejemplo.com">
                </div>
            @endfor
        </div>

        <p class="text-xs text-green-600 mt-3">
            Puedes agregar links a videos, carpetas, imágenes o documentos externos.
        </p>
    </div>
</div>

                    </div>

                    {{-- INFORMACION --}}
                    <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4">

                        <div class="flex gap-3">

                            <x-heroicon-o-information-circle
                                class="w-6 h-6 text-green-600 flex-shrink-0" />

                            <div>

                                <p class="font-semibold text-green-700">
                                    Información
                                </p>

                                <p class="text-sm text-green-600">
                                    Los participantes no tienen acceso al sistema.
                                    Solamente son registrados para ser evaluados por los jurados.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- BOTONES --}}
                    <div class="flex flex-wrap gap-2 mt-8 border-t pt-6">

                        <button
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                            <x-heroicon-o-check class="w-5 h-5" />
                            Guardar participante

                        </button>

                        <a href="{{ route('participantes.index', ['concurso_id' => $concursoId]) }}"
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