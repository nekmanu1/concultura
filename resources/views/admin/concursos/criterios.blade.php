<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-purple-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Asignar criterios a aspectos
                </h2>
                <p class="text-sm text-gray-500">
                    Distribuye los criterios dentro de las secciones del concurso
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-700 p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-200 text-red-700 p-4 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">

            <div class="bg-gradient-to-r from-purple-700 to-purple-500 text-white p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $concurso->nombre }}
                        </h1>

                        <p class="text-purple-100 mt-1">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>

                    <span class="inline-flex items-center gap-2 bg-white text-purple-700 px-4 py-2 rounded-full text-sm font-semibold">
                        <x-heroicon-o-check-circle class="w-5 h-5" />
                        {{ $asignados->count() }} criterios asignados
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="bg-purple-50 border border-purple-200 rounded-xl p-4 flex gap-3">
                    <x-heroicon-o-information-circle class="w-6 h-6 text-purple-600 flex-shrink-0" />

                    <p class="text-sm text-purple-700">
                        Selecciona en qué aspecto irá cada criterio. Si dejas un criterio sin seleccionar,
                        no será usado en este concurso.
                    </p>
                </div>
            </div>

        </div>

        <form action="{{ route('concursos.criterios.guardar', $concurso) }}" method="POST">
            @csrf

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-left font-semibold text-gray-700">
                                Criterio
                            </th>

                            <th class="p-4 text-left font-semibold text-gray-700">
                                Puntaje máximo
                            </th>

                            <th class="p-4 text-left font-semibold text-gray-700">
                                Aspecto asignado
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($criterios as $criterio)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <td class="p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <x-heroicon-o-check-circle class="w-5 h-5 text-yellow-600" />
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $criterio->nombre }}
                                            </p>

                                            @if($criterio->descripcion)
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $criterio->descripcion }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-400 mt-1">
                                                    Sin descripción
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        <x-heroicon-o-star class="w-4 h-4" />
                                        {{ number_format($criterio->puntaje_maximo, 2) }} pts
                                    </span>
                                </td>

                                <td class="p-4">
                                    <select name="aspectos[{{ $criterio->id }}]"
                                            class="w-full border-gray-300 rounded-xl focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">No usar en este concurso</option>

                                        @foreach($aspectos as $aspecto)
                                            <option value="{{ $aspecto->id }}"
                                                {{ isset($asignadosPorCriterio[$criterio->id]) && $asignadosPorCriterio[$criterio->id]->aspecto_id == $aspecto->id ? 'selected' : '' }}>
                                                {{ $aspecto->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-8 text-center text-gray-500">
                                    <x-heroicon-o-check-circle class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    No hay criterios registrados para esta categoría.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <div class="flex flex-wrap gap-2 mt-6">
                <button class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl shadow">
                    <x-heroicon-o-check class="w-5 h-5" />
                    Guardar asignación
                </button>

                <a href="{{ route('concursos.show', $concurso) }}"
                   class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">
                    <x-heroicon-o-arrow-left class="w-5 h-5" />
                    Volver
                </a>
            </div>
        </form>

        @if($asignados->count())
            <div class="bg-white rounded-2xl shadow overflow-hidden mt-8">

                <div class="p-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">
                        Asignación actual
                    </h3>
                    <p class="text-sm text-gray-500">
                        Criterios actualmente utilizados en este concurso
                    </p>
                </div>

                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-left font-semibold text-gray-700">
                                Aspecto
                            </th>
                            <th class="p-4 text-left font-semibold text-gray-700">
                                Criterio
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($asignados->groupBy('aspecto_id') as $grupo)
                            @foreach($grupo as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            <x-heroicon-o-clipboard-document-list class="w-4 h-4" />
                                            {{ $item->aspecto->nombre }}
                                        </span>
                                    </td>

                                    <td class="p-4 font-medium text-gray-800">
                                        {{ $item->criterio->nombre }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif

    </div>

</x-app-layout>