<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Asignar criterios a aspectos
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow mb-6">
            <p class="mb-2">
                <strong>Concurso:</strong> {{ $concurso->nombre }}
            </p>

            <p class="mb-2">
                <strong>Categoría:</strong> {{ $concurso->categoria->nombre }}
            </p>

            <p class="text-sm text-gray-600">
                Selecciona en qué aspecto irá cada criterio. Si dejas un criterio sin seleccionar, no será usado en este concurso.
            </p>
        </div>

        <form action="{{ route('concursos.criterios.guardar', $concurso) }}" method="POST">
            @csrf

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 border">Criterio</th>
                            <th class="p-3 border">Puntaje máximo</th>
                            <th class="p-3 border">Aspecto asignado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($criterios as $criterio)
                            <tr>
                                <td class="p-3 border">
                                    <strong>{{ $criterio->nombre }}</strong>

                                    @if($criterio->descripcion)
                                        <p class="text-sm text-gray-600">
                                            {{ $criterio->descripcion }}
                                        </p>
                                    @endif
                                </td>

                                <td class="p-3 border">
                                    {{ $criterio->puntaje_maximo }}
                                </td>

                                <td class="p-3 border">
                                    <select name="aspectos[{{ $criterio->id }}]"
                                            class="w-full border-gray-300 rounded">
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
                                <td colspan="3" class="p-3 text-center">
                                    No hay criterios registrados para esta categoría.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex gap-2 mt-6">
                <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    <x-heroicon-o-check class="w-5 h-5" />
                    Guardar asignación
                </button>

                <a href="{{ route('concursos.show', $concurso) }}"
                   class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
    <x-heroicon-o-arrow-left class="w-5 h-5" />
                    Volver
                </a>
            </div>
        </form>

        @if($asignados->count())
            <div class="bg-white p-6 rounded shadow mt-6">
                <h3 class="text-lg font-bold mb-4">
                    Asignación actual
                </h3>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 border">Aspecto</th>
                            <th class="p-3 border">Criterio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asignados->groupBy('aspecto_id') as $grupo)
                            @foreach($grupo as $item)
                                <tr>
                                    <td class="p-3 border">{{ $item->aspecto->nombre }}</td>
                                    <td class="p-3 border">{{ $item->criterio->nombre }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>