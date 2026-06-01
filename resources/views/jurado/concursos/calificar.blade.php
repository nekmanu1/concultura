<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Calificar concurso
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

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
                Solo puedes calificar los aspectos que te fueron asignados.
            </p>
        </div>

        @if($participantes->count() == 0)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                Este concurso no tiene participantes registrados.
            </div>
        @elseif($concursoCriterios->count() == 0)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                No tienes criterios asignados para calificar en este concurso.
            </div>
        @else
            <form action="{{ route('jurado.concursos.guardar', $concurso) }}" method="POST">
                @csrf

                @foreach($participantes as $participante)
                    <div class="bg-white rounded shadow mb-6 overflow-hidden">
                        <div class="bg-gray-100 p-4">
                            <h3 class="text-lg font-bold">
                                {{ $participante->nombre }}
                            </h3>

                            @if($participante->cedula)
                                <p class="text-sm text-gray-600">
                                    Cédula: {{ $participante->cedula }}
                                </p>
                            @endif

                            @if($participante->descripcion)
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $participante->descripcion }}
                                </p>
                            @endif
                        </div>

                        @foreach($concursoCriterios as $grupo)
                            @php
                                $aspecto = $grupo->first()->aspecto;
                            @endphp

                            <div class="p-4 border-t">
                                <h4 class="font-bold text-blue-700 mb-3">
                                    {{ $aspecto->nombre }}
                                </h4>

                                <div class="overflow-x-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-gray-50 text-left">
                                                <th class="p-3 border">Criterio</th>
                                                <th class="p-3 border">Máximo</th>
                                                <th class="p-3 border">Puntaje</th>
                                                <th class="p-3 border">Observación</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($grupo as $item)
                                                @php
                                                    $key = $participante->id . '-' . $item->criterio_id;
                                                    $evaluacion = $evaluaciones[$key] ?? null;
                                                @endphp

                                                <tr>
                                                    <td class="p-3 border">
                                                        <strong>{{ $item->criterio->nombre }}</strong>

                                                        @if($item->criterio->descripcion)
                                                            <p class="text-sm text-gray-600">
                                                                {{ $item->criterio->descripcion }}
                                                            </p>
                                                        @endif
                                                    </td>

                                                    <td class="p-3 border">
                                                        {{ $item->criterio->puntaje_maximo }}
                                                    </td>

                                                    <td class="p-3 border">
                                                        <input type="number"
                                                               step="0.01"
                                                               min="0"
                                                               max="{{ $item->criterio->puntaje_maximo }}"
                                                               name="puntajes[{{ $participante->id }}][{{ $item->criterio_id }}]"
                                                               value="{{ old('puntajes.' . $participante->id . '.' . $item->criterio_id, $evaluacion->puntaje ?? '') }}"
                                                               class="w-28 border-gray-300 rounded">
                                                    </td>

                                                    <td class="p-3 border">
                                                        <textarea name="observaciones[{{ $participante->id }}][{{ $item->criterio_id }}]"
                                                                  class="w-full border-gray-300 rounded"
                                                                  rows="2">{{ old('observaciones.' . $participante->id . '.' . $item->criterio_id, $evaluacion->observacion ?? '') }}</textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Guardar calificación
                    </button>

                    <a href="{{ route('jurado.concursos.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Volver
                    </a>
                </div>
            </form>
        @endif

    </div>
</x-app-layout>