<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <x-heroicon-o-trophy class="w-6 h-6 text-yellow-600" />
            <h2 class="text-xl font-semibold text-gray-800">
                Detalle del concurso
            </h2>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- ENCABEZADO --}}
            <div class="bg-gradient-to-r from-yellow-700 to-yellow-600 text-white p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $concurso->nombre }}
                        </h1>

                        <p class="text-yellow-100 mt-1">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold
                        @if($concurso->estado === 'ACTIVO') bg-green-100 text-green-700
                        @elseif($concurso->estado === 'CERRADO') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-800
                        @endif">

                        @if($concurso->estado === 'ACTIVO')
                            <x-heroicon-o-play-circle class="w-5 h-5" />
                        @elseif($concurso->estado === 'CERRADO')
                            <x-heroicon-o-lock-closed class="w-5 h-5" />
                        @else
                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                        @endif

                        {{ $concurso->estado }}
                    </span>

                </div>
            </div>

            {{-- CONTENIDO --}}
            <div class="p-6">

                @if($concurso->estado === 'CERRADO')
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl flex gap-3">
                        <x-heroicon-o-lock-closed class="w-6 h-6 flex-shrink-0" />
                        <div>
                            <p class="font-bold">Concurso cerrado</p>
                            <p class="text-sm">
                                Este concurso está en modo solo lectura. Solo se permiten consultas y resultados.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- INFORMACIÓN GENERAL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <div class="border rounded-xl p-4 bg-gray-50">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                            Categoría
                        </div>
                        <p class="font-semibold text-gray-800">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>

                    <div class="border rounded-xl p-4 bg-gray-50">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-calendar-days class="w-5 h-5" />
                            Periodo
                        </div>
                        <p class="font-semibold text-gray-800">
                            {{ $concurso->fecha_inicio ?? 'No definida' }}
                            -
                            {{ $concurso->fecha_fin ?? 'No definida' }}
                        </p>
                    </div>

                    <div class="border rounded-xl p-4 bg-gray-50 md:col-span-2">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-document-text class="w-5 h-5" />
                            Descripción
                        </div>
                        <p class="font-medium text-gray-800">
                            {{ $concurso->descripcion ?? 'Sin descripción' }}
                        </p>
                    </div>

                </div>

                {{-- ACCIONES PRINCIPALES --}}
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    Acciones del concurso
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

                    @if($concurso->estado !== 'CERRADO')
                        <a href="{{ route('concursos.criterios', $concurso) }}"
                           class="group border border-purple-200 bg-purple-50 hover:bg-purple-600 rounded-xl p-5 transition">
                            <x-heroicon-o-clipboard-document-list class="w-8 h-8 text-purple-600 group-hover:text-white mb-3" />
                            <p class="font-bold text-gray-800 group-hover:text-white">
                                Criterios
                            </p>
                            <p class="text-sm text-gray-500 group-hover:text-purple-100">
                                Asignar criterios a aspectos
                            </p>
                        </a>

                        <a href="{{ route('participantes.index', ['concurso_id' => $concurso->id]) }}"
                           class="group border border-green-200 bg-green-50 hover:bg-green-600 rounded-xl p-5 transition">
                            <x-heroicon-o-user-group class="w-8 h-8 text-green-600 group-hover:text-white mb-3" />
                            <p class="font-bold text-gray-800 group-hover:text-white">
                                Participantes
                            </p>
                            <p class="text-sm text-gray-500 group-hover:text-green-100">
                                Gestionar participantes
                            </p>
                        </a>

                        <a href="{{ route('concursos.jurados', $concurso) }}"
                           class="group border border-blue-200 bg-blue-50 hover:bg-blue-600 rounded-xl p-5 transition">
                            <x-heroicon-o-users class="w-8 h-8 text-blue-600 group-hover:text-white mb-3" />
                            <p class="font-bold text-gray-800 group-hover:text-white">
                                Jurados
                            </p>
                            <p class="text-sm text-gray-500 group-hover:text-blue-100">
                                Asignar jurados
                            </p>
                        </a>
                    @endif

                    <a href="{{ route('concursos.resultados', $concurso) }}"
                       class="group border border-gray-300 bg-gray-50 hover:bg-gray-800 rounded-xl p-5 transition">
                        <x-heroicon-o-chart-bar class="w-8 h-8 text-gray-700 group-hover:text-white mb-3" />
                        <p class="font-bold text-gray-800 group-hover:text-white">
                            Resultados
                        </p>
                        <p class="text-sm text-gray-500 group-hover:text-gray-200">
                            Ver resultados del concurso
                        </p>
                    </a>

                </div>

                {{-- BOTONES INFERIORES --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-t pt-6">

                    <div class="flex flex-wrap gap-2">
                        @if($concurso->estado !== 'CERRADO')
                            <a href="{{ route('concursos.edit', $concurso) }}"
                               class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                <x-heroicon-o-pencil-square class="w-5 h-5" />
                                Editar
                            </a>
                        @endif

                        <a href="{{ route('concursos.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            <x-heroicon-o-arrow-left class="w-5 h-5" />
                            Volver
                        </a>
                    </div>

                    @if($concurso->estado !== 'CERRADO')
                        <form action="{{ route('concursos.cerrar', $concurso) }}"
                              method="POST"
                              onsubmit="return confirm('¿Deseas cerrar este concurso? Después los jurados no podrán seguir calificando.')">
                            @csrf

                            <button class="inline-flex items-center gap-2 bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg">
                                <x-heroicon-o-lock-closed class="w-5 h-5" />
                                Cerrar concurso
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>