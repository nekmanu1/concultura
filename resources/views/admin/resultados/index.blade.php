<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Resultados del concurso
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        <div class="bg-white p-6 rounded shadow mb-6">
            <p class="mb-2">
                <strong>Concurso:</strong> {{ $concurso->nombre }}
            </p>

            <p class="mb-2">
                <strong>Categoría:</strong> {{ $concurso->categoria->nombre }}
            </p>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('concursos.resultados.exportarResumenPDF', $concurso) }}"
                   class="bg-green-600 text-white px-4 py-2 rounded">
                    Exportar resumen
                </a>

                <a href="{{ route('concursos.resultados.exportarDesgloseExcel', $concurso) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    Exportar desglose
                </a>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto mb-6">
            <h3 class="text-lg font-bold p-4 border-b">
                Tabla de resultados
            </h3>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Posición</th>
                        <th class="p-3 border">Participante</th>
                        <th class="p-3 border">Cédula</th>
                        <th class="p-3 border">Puntaje total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($resultados as $index => $resultado)
                        <tr>
                            <td class="p-3 border">
                                {{ $index + 1 }}
                            </td>

                            <td class="p-3 border">
                                {{ $resultado->nombre }}
                            </td>

                            <td class="p-3 border">
                                {{ $resultado->cedula ?? 'No registrada' }}
                            </td>

                            <td class="p-3 border font-bold">
                                {{ number_format($resultado->total, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center">
                                Todavía no hay evaluaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <h3 class="text-lg font-bold p-4 border-b">
                Desglose de votación
            </h3>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Participante</th>
                        <th class="p-3 border">Jurado</th>
                        <th class="p-3 border">Aspecto</th>
                        <th class="p-3 border">Criterio</th>
                        <th class="p-3 border">Puntaje</th>
                        <th class="p-3 border">Observación</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($desglose as $item)
                        <tr>
                            <td class="p-3 border">
                                {{ $item->participante->nombre }}
                            </td>

                            <td class="p-3 border">
                                {{ $item->jurado->name }}
                            </td>

                            <td class="p-3 border">
                                {{ $item->aspecto->nombre }}
                            </td>

                            <td class="p-3 border">
                                {{ $item->criterio->nombre }}
                            </td>

                            <td class="p-3 border font-bold">
                                {{ number_format($item->puntaje, 2) }}
                            </td>

                            <td class="p-3 border">
                                {{ $item->observacion ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center">
                                Todavía no hay desglose disponible.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('concursos.show', $concurso) }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Volver al concurso
            </a>
        </div>

    </div>
</x-app-layout>