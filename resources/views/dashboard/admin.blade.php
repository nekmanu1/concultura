<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-1">
            Panel de Administración
        </h2>

        <p class="text-gray-500 mb-6">
            Resumen general del sistema de votación
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Usuarios</p>
                <h3 class="text-3xl font-bold text-blue-600">
                    {{ $totalUsuarios ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de usuarios</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Categorías</p>
                <h3 class="text-3xl font-bold text-green-600">
                    {{ $totalCategorias ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de categorías</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Aspectos</p>
                <h3 class="text-3xl font-bold text-purple-600">
                    {{ $totalAspectos ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de aspectos</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Criterios</p>
                <h3 class="text-3xl font-bold text-yellow-600">
                    {{ $totalCriterios ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de criterios</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Concursos</p>
                <h3 class="text-3xl font-bold text-red-600">
                    {{ $totalConcursos ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de concursos</p>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <p class="text-gray-500 text-sm">Participantes</p>
                <h3 class="text-3xl font-bold text-gray-700">
                    {{ $totalParticipantes ?? 0 }}
                </h3>
                <p class="text-xs text-gray-400">Total de participantes</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">
                    Concursos por estado
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span>Borrador</span>
                        <strong>{{ $concursosBorrador ?? 0 }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span>Activos</span>
                        <strong>{{ $concursosActivos ?? 0 }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span>Cerrados</span>
                        <strong>{{ $concursosCerrados ?? 0 }}</strong>
                    </div>

                    <div class="flex justify-between pt-2 text-lg">
                        <span>Total</span>
                        <strong>{{ $totalConcursos ?? 0 }}</strong>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">
                    Participantes por concurso
                </h3>

                @forelse($participantesPorConcurso ?? [] as $item)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm">{{ $item->nombre }}</span>
                            <strong>{{ $item->participantes_count }}</strong>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full"
                                 style="width: {{ min($item->participantes_count * 10, 100) }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">
                        No hay concursos con participantes.
                    </p>
                @endforelse
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">
                    Evaluaciones por concurso
                </h3>

                @forelse($evaluacionesPorConcurso ?? [] as $item)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm">{{ $item->nombre }}</span>
                            <strong>{{ $item->evaluaciones_count }}</strong>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-600 h-3 rounded-full"
                                 style="width: {{ min($item->evaluaciones_count * 5, 100) }}%">
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">
                        Todavía no hay evaluaciones registradas.
                    </p>
                @endforelse
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-bold mb-4">
                    Últimos concursos
                </h3>

                <div class="space-y-3">
                    @forelse($ultimosConcursos ?? [] as $concurso)
                        <div class="border-b pb-3">
                            <p class="font-semibold">
                                {{ $concurso->nombre }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $concurso->categoria->nombre ?? 'Sin categoría' }} |
                                Estado: {{ $concurso->estado }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">
                            No hay concursos registrados.
                        </p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</x-app-layout>