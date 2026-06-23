<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-user-circle class="w-7 h-7 text-green-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ver participante
                </h2>

                <p class="text-sm text-gray-500">
                    Información detallada del participante
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- ENCABEZADO --}}
            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 text-white">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                            <x-heroicon-o-user class="w-10 h-10 text-white" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ $participante->nombre }}
                            </h1>

                            <p class="text-green-100">
                                Participante del concurso
                            </p>
                        </div>

                    </div>

                    <span class="inline-flex items-center gap-2 bg-white text-green-700 px-4 py-2 rounded-full font-semibold">
                        <x-heroicon-o-trophy class="w-5 h-5" />
                        {{ $participante->concurso->nombre }}
                    </span>

                </div>

            </div>

            {{-- CONTENIDO --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-user class="w-5 h-5" />
                            Nombre completo
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $participante->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-identification class="w-5 h-5" />
                            Cédula
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $participante->cedula ?? 'No registrada' }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-trophy class="w-5 h-5" />
                            Concurso
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $participante->concurso->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-phone class="w-5 h-5" />
                            Teléfono
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $participante->telefono ?? 'No registrado' }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4 md:col-span-2">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                            Correo electrónico
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $participante->correo ?? 'No registrado' }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4 md:col-span-2">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-2">
                            <x-heroicon-o-document-text class="w-5 h-5" />
                            Descripción
                        </div>

                        <p class="text-gray-800 leading-relaxed">
                            {{ $participante->descripcion ?? 'Sin descripción registrada.' }}
                        </p>

                    </div>

                    @if($participante->recursos->count())
    <div class="bg-gray-50 border rounded-xl p-4 md:col-span-2">
        <div class="flex items-center gap-2 text-gray-500 text-sm mb-3">
            <x-heroicon-o-link class="w-5 h-5" />
            Recursos
        </div>

        <div class="space-y-2">
            @foreach($participante->recursos as $recurso)
                <a href="{{ $recurso->url }}"
                   target="_blank"
                   class="flex items-center gap-2 text-green-700 hover:text-green-900 underline">
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                    {{ $recurso->titulo ?: $recurso->url }}
                </a>
            @endforeach
        </div>
    </div>
@endif

                </div>

                {{-- RESUMEN --}}
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-5 mb-8">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <x-heroicon-o-user-group class="w-6 h-6 text-green-600" />
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Concurso asignado
                            </p>

                            <h3 class="text-xl font-bold text-green-700">
                                {{ $participante->concurso->nombre }}
                            </h3>
                        </div>

                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="flex flex-wrap gap-2 border-t pt-6">

                    @if($participante->concurso->estado !== 'CERRADO')
                        <a href="{{ route('participantes.edit', $participante) }}"
                           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                            Editar participante

                        </a>
                    @endif

                    <a href="{{ route('participantes.index', ['concurso_id' => $participante->concurso_id]) }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                        <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Volver

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>