<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center gap-3">
            <x-heroicon-o-trophy class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Mis concursos asignados
                </h2>

                <p class="text-sm text-gray-500">
                    Concursos disponibles para evaluación
                </p>
            </div>
        </div>

    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 p-4 rounded-xl">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- CABECERA --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white rounded-2xl shadow-lg p-6 mb-6">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <x-heroicon-o-clipboard-document-check class="w-8 h-8 text-white" />
                </div>

                <div>
                    <h1 class="text-2xl font-bold">
                        Concursos asignados
                    </h1>

                    <p class="text-blue-100">
                        Selecciona un concurso para registrar tus evaluaciones.
                    </p>
                </div>

            </div>

        </div>

        {{-- TABLA --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="p-5 border-b bg-gray-50">
                <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                    <x-heroicon-o-list-bullet class="w-5 h-5 text-blue-600" />
                    Listado de concursos
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="bg-gray-100 text-left">

                            <th class="p-4 border-b">Concurso</th>
                            <th class="p-4 border-b">Categoría</th>
                            <th class="p-4 border-b">Fecha inicio</th>
                            <th class="p-4 border-b">Fecha fin</th>
                            <th class="p-4 border-b">Estado</th>
                            <th class="p-4 border-b text-center">Acción</th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($concursos as $concurso)

                            <tr class="hover:bg-gray-50">

                                <td class="p-4 border-b">
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-trophy class="w-5 h-5 text-red-500" />

                                        <span class="font-medium">
                                            {{ $concurso->nombre }}
                                        </span>
                                    </div>
                                </td>

                                <td class="p-4 border-b">
                                    {{ $concurso->categoria->nombre }}
                                </td>

                                <td class="p-4 border-b">
                                    {{ $concurso->fecha_inicio ?? 'No definida' }}
                                </td>

                                <td class="p-4 border-b">
                                    {{ $concurso->fecha_fin ?? 'No definida' }}
                                </td>

                                <td class="p-4 border-b">

                                    @if($concurso->estado === 'ACTIVO')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            ACTIVO
                                        </span>
                                    @elseif($concurso->estado === 'CERRADO')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            CERRADO
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            BORRADOR
                                        </span>
                                    @endif

                                </td>

                                <td class="p-4 border-b text-center">

                                    <a href="{{ route('jurado.concursos.calificar', $concurso) }}"
                                       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">

                                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                                        Calificar

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="py-12 text-center">

                                    <x-heroicon-o-face-frown class="w-12 h-12 text-gray-300 mx-auto mb-3" />

                                    <p class="text-gray-500">
                                        No tienes concursos asignados.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-6">
            {{ $concursos->links() }}
        </div>

    </div>

</x-app-layout>