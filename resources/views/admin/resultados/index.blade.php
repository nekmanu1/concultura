<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-chart-bar class="w-7 h-7 text-indigo-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Resultados del concurso
                </h2>

                <p class="text-sm text-gray-500">
                    Clasificación final y desglose de votaciones
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        {{-- CABECERA --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">

            <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 text-white p-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $concurso->nombre }}
                        </h1>

                        <p class="text-indigo-100">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">

                        <a href="{{ route('concursos.resultados.exportarResumenPDF', $concurso) }}"
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl">

                            <x-heroicon-o-document-arrow-down class="w-5 h-5" />
                            Exportar resumen
                        </a>

                        <a href="{{ route('concursos.resultados.exportarDesgloseExcel', $concurso) }}"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">

                            <x-heroicon-o-table-cells class="w-5 h-5" />
                            Exportar desglose
                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- PODIO --}}
        @if($resultados->count())

        <div class="grid md:grid-cols-3 gap-4 mb-8">

            @foreach($resultados->take(3) as $index => $resultado)

                <div class="bg-white rounded-2xl shadow p-5 text-center">

                    @if($index == 0)
                        <div class="text-yellow-500 mb-2">
                            <x-heroicon-o-trophy class="w-12 h-12 mx-auto" />
                        </div>
                        <h3 class="font-bold text-lg text-yellow-700">
                            🥇 Primer Lugar
                        </h3>

                    @elseif($index == 1)
                        <div class="text-gray-500 mb-2">
                            <x-heroicon-o-trophy class="w-10 h-10 mx-auto" />
                        </div>
                        <h3 class="font-bold text-gray-700">
                            🥈 Segundo Lugar
                        </h3>

                    @else
                        <div class="text-amber-700 mb-2">
                            <x-heroicon-o-trophy class="w-10 h-10 mx-auto" />
                        </div>
                        <h3 class="font-bold text-amber-700">
                            🥉 Tercer Lugar
                        </h3>
                    @endif

                    <p class="mt-3 font-semibold text-gray-800">
                        {{ $resultado->nombre }}
                    </p>

                    <p class="text-2xl font-bold text-indigo-600 mt-2">
                        {{ number_format($resultado->total, 2) }}
                    </p>

                </div>

            @endforeach

        </div>

        @endif

        {{-- RESULTADOS --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden mb-6">

            <div class="p-5 border-b bg-gray-50">
                <h3 class="text-lg font-bold text-gray-800">
                    Ranking General
                </h3>
            </div>

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left">Posición</th>
                        <th class="p-4 text-left">Participante</th>
                        <th class="p-4 text-left">Cédula</th>
                        <th class="p-4 text-left">Puntaje total</th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($resultados as $index => $resultado)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">

                                @if($index == 0)
                                    🥇
                                @elseif($index == 1)
                                    🥈
                                @elseif($index == 2)
                                    🥉
                                @else
                                    {{ $index + 1 }}
                                @endif

                            </td>

                            <td class="p-4 font-semibold">
                                {{ $resultado->nombre }}
                            </td>

                            <td class="p-4">
                                {{ $resultado->cedula ?? 'No registrada' }}
                            </td>

                            <td class="p-4">

                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-semibold">

                                    <x-heroicon-o-star class="w-4 h-4" />

                                    {{ number_format($resultado->total, 2) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">

                                <x-heroicon-o-chart-bar
                                    class="w-10 h-10 mx-auto mb-3 text-gray-300" />

                                Todavía no hay evaluaciones registradas.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- DESGLOSE --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="p-5 border-b bg-gray-50">

                <h3 class="text-lg font-bold text-gray-800">
                    Desglose de votación
                </h3>

                <p class="text-sm text-gray-500">
                    Detalle completo de todas las evaluaciones realizadas
                </p>

            </div>

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left">Participante</th>
                        <th class="p-4 text-left">Jurado</th>
                        <th class="p-4 text-left">Aspecto</th>
                        <th class="p-4 text-left">Criterio</th>
                        <th class="p-4 text-left">Puntaje</th>
                        <th class="p-4 text-left">Observación</th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($desglose as $item)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4">
                                {{ $item->participante->nombre }}
                            </td>

                            <td class="p-4">
                                {{ $item->jurado->name }}
                            </td>

                            <td class="p-4">
                                {{ $item->aspecto->nombre }}
                            </td>

                            <td class="p-4">
                                {{ $item->criterio->nombre }}
                            </td>

                            <td class="p-4">

                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">

                                    {{ number_format($item->puntaje, 2) }}

                                </span>

                            </td>

                            <td class="p-4">
                                {{ $item->observacion ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">

                                <x-heroicon-o-document-text
                                    class="w-10 h-10 mx-auto mb-3 text-gray-300" />

                                Todavía no hay desglose disponible.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            <a href="{{ route('concursos.show', $concurso) }}"
               class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">

                <x-heroicon-o-arrow-left class="w-5 h-5" />

                Volver al concurso

            </a>

        </div>

    </div>

</x-app-layout>