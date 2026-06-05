<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Panel de Administración
            </h2>
            <p class="text-gray-500">
                Resumen general del sistema de votación
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-4 mb-6">

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Usuarios</p>
                <h3 class="text-3xl font-bold text-blue-600">{{ $totalUsuarios }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Categorías</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $totalCategorias }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Aspectos</p>
                <h3 class="text-3xl font-bold text-purple-600">{{ $totalAspectos }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Criterios</p>
                <h3 class="text-3xl font-bold text-yellow-600">{{ $totalCriterios }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Concursos</p>
                <h3 class="text-3xl font-bold text-red-600">{{ $totalConcursos }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Participantes</p>
                <h3 class="text-3xl font-bold text-gray-700">{{ $totalParticipantes }}</h3>
            </div>

            <div class="bg-white p-5 rounded-lg shadow">
                <p class="text-gray-500 text-sm">Evaluaciones</p>
                <h3 class="text-3xl font-bold text-indigo-600">{{ $totalEvaluaciones }}</h3>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">
                    Concursos por estado
                </h3>

                <canvas id="concursosEstadoChart" height="220"></canvas>
            </div>

            <div class="bg-white p-6 rounded-lg shadow lg:col-span-2">
                <h3 class="text-lg font-bold mb-4">
                    Participantes por concurso
                </h3>

                <canvas id="participantesChart" height="120"></canvas>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">
                    Evaluaciones por concurso
                </h3>

                <canvas id="evaluacionesChart" height="160"></canvas>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">
                    Últimos concursos
                </h3>

                <div class="space-y-3">
                    @forelse($ultimosConcursos as $concurso)
                        <div class="border-b pb-3">
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-semibold">
                                        {{ $concurso->nombre }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $concurso->categoria->nombre ?? 'Sin categoría' }}
                                    </p>
                                </div>

                                <span class="text-xs px-2 py-1 rounded h-fit
                                    @if($concurso->estado === 'ACTIVO') bg-green-100 text-green-700
                                    @elseif($concurso->estado === 'CERRADO') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ $concurso->estado }}
                                </span>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const concursosEstadoCtx = document.getElementById('concursosEstadoChart');

        new Chart(concursosEstadoCtx, {
            type: 'doughnut',
            data: {
                labels: ['Borrador', 'Activos', 'Cerrados'],
                datasets: [{
                    data: [
                        {{ $concursosBorrador }},
                        {{ $concursosActivos }},
                        {{ $concursosCerrados }}
                    ],
                    backgroundColor: [
                        '#facc15',
                        '#22c55e',
                        '#ef4444'
                    ]
                }]
            }
        });

        const participantesCtx = document.getElementById('participantesChart');

        new Chart(participantesCtx, {
            type: 'bar',
            data: {
                labels: @json($participantesLabels),
                datasets: [{
                    label: 'Participantes',
                    data: @json($participantesData),
                    backgroundColor: '#2563eb'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        const evaluacionesCtx = document.getElementById('evaluacionesChart');

        new Chart(evaluacionesCtx, {
            type: 'bar',
            data: {
                labels: @json($evaluacionesLabels),
                datasets: [{
                    label: 'Evaluaciones',
                    data: @json($evaluacionesData),
                    backgroundColor: '#16a34a'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>