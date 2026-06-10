<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-chart-bar class="w-7 h-7 text-slate-700" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Dashboard
                </h2>

                <p class="text-sm text-gray-500">
                    Panel general del sistema de votación
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        {{-- BANNER --}}
        <div class="bg-gradient-to-r from-slate-800 to-slate-700 text-white rounded-2xl shadow-lg p-8 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center">
                    <x-heroicon-o-chart-bar class="w-8 h-8" />
                </div>

                <div>
                    <h1 class="text-3xl font-bold">
                        Panel de Administración
                    </h1>

                    <p class="text-slate-300">
                        Resumen general, estadísticas y seguimiento de concursos.
                    </p>
                </div>
            </div>
        </div>

        

        {{-- TARJETAS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-4 mb-6">

            <div class="bg-white p-5 rounded-xl shadow border-l ">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Usuarios</p>
                        <h3 class="text-3xl font-bold text-blue-600">{{ $totalUsuarios }}</h3>
                    </div>
                    <x-heroicon-o-users class="w-10 h-10 text-blue-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Categorías</p>
                        <h3 class="text-3xl font-bold text-green-600">{{ $totalCategorias }}</h3>
                    </div>
                    <x-heroicon-o-squares-2x2 class="w-10 h-10 text-green-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Aspectos</p>
                        <h3 class="text-3xl font-bold text-purple-600">{{ $totalAspectos }}</h3>
                    </div>
                    <x-heroicon-o-clipboard-document-list class="w-10 h-10 text-purple-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Criterios</p>
                        <h3 class="text-3xl font-bold text-amber-600">{{ $totalCriterios }}</h3>
                    </div>
                    <x-heroicon-o-list-bullet class="w-10 h-10 text-amber-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Concursos</p>
                        <h3 class="text-3xl font-bold text-red-600">{{ $totalConcursos }}</h3>
                    </div>
                    <x-heroicon-o-trophy class="w-10 h-10 text-red-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-l">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Participantes</p>
                        <h3 class="text-3xl font-bold text-emerald-600">{{ $totalParticipantes }}</h3>
                    </div>
                    <x-heroicon-o-user-group class="w-10 h-10 text-emerald-200" />
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow border-1">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Evaluaciones</p>
                        <h3 class="text-3xl font-bold text-indigo-600">{{ $totalEvaluaciones }}</h3>
                    </div>
                    <x-heroicon-o-chart-bar class="w-10 h-10 text-indigo-200" />
                </div>
            </div>

        </div>

        {{-- GRÁFICAS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <x-heroicon-o-chart-pie class="w-5 h-5 text-indigo-600" />
                    Concursos por estado
                </h3>

                <canvas id="concursosEstadoChart" height="220"></canvas>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg lg:col-span-2">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <x-heroicon-o-user-group class="w-5 h-5 text-green-600" />
                    Participantes por concurso
                </h3>

                <canvas id="participantesChart" height="120"></canvas>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <x-heroicon-o-chart-bar class="w-5 h-5 text-blue-600" />
                    Evaluaciones por concurso
                </h3>

                <canvas id="evaluacionesChart" height="160"></canvas>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <x-heroicon-o-clock class="w-5 h-5 text-slate-600" />
                    Últimos concursos
                </h3>

                <div class="space-y-3">
                    @forelse($ultimosConcursos as $concurso)
                        <div class="border-b pb-3">
                            <div class="flex justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-trophy class="w-5 h-5 text-red-500" />

                                        <p class="font-semibold">
                                            {{ $concurso->nombre }}
                                        </p>
                                    </div>

                                    <p class="text-sm text-gray-500 ml-7">
                                        {{ $concurso->categoria->nombre ?? 'Sin categoría' }}
                                    </p>
                                </div>

                                <span class="text-xs px-3 py-1 rounded-full h-fit font-semibold
                                    @if($concurso->estado === 'ACTIVO') bg-green-100 text-green-700
                                    @elseif($concurso->estado === 'CERRADO') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ $concurso->estado }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <x-heroicon-o-trophy class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                            No hay concursos registrados.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        new Chart(document.getElementById('concursosEstadoChart'), {
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

        new Chart(document.getElementById('participantesChart'), {
            type: 'bar',
            data: {
                labels: @json($participantesLabels),
                datasets: [{
                    label: 'Participantes',
                    data: @json($participantesData),
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

        new Chart(document.getElementById('evaluacionesChart'), {
            type: 'bar',
            data: {
                labels: @json($evaluacionesLabels),
                datasets: [{
                    label: 'Evaluaciones',
                    data: @json($evaluacionesData),
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
    </script>
</x-app-layout>