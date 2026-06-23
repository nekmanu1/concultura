<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-pencil-square class="w-7 h-7 text-blue-600" />
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Calificar concurso
                </h2>
                <p class="text-sm text-gray-500">
                    Evaluación de participantes asignados
                </p>
            </div>
        </div>
    </x-slot>




    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 p-4 rounded-xl">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5" />
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-trophy class="w-8 h-8 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $concurso->nombre }}
                        </h1>

                        <p class="text-blue-100">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>
                </div>
<!-- Select de participantes -->
<div class="bg-white border border-gray-200 shadow-sm mb-6 flex justify-center rounded-xl">
    <form method="GET" action="{{ route('jurado.concursos.calificar', $concurso->id) }}" 
          class="flex gap-2 items-center max-w-md w-full p-4">

        <label for="participante" class="text-sm font-medium text-blue-600">Seleccionar participante:</label>

        <select id="participante" name="search"
                class="w-64 border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 text-black">
            <option value="">Participantes</option>
            @foreach($participantesSelect as $p)
                <option value="{{ $p->cedula }}" 
                        {{ request('search') == $p->cedula ? 'selected' : '' }}>
                    {{ $p->nombre }} ({{ $p->cedula }})
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
            Ver
        </button>
    </form>
</div>

              <span class="inline-flex items-center gap-2 bg-white text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
    <x-heroicon-o-user-group class="w-5 h-5" />
    Participante {{ $participantes->firstItem() }} de {{ $participantes->total() }}
</span>

            </div>
        </div>

        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex gap-3">
                <x-heroicon-o-information-circle class="w-6 h-6 text-blue-600 flex-shrink-0" />

                <p class="text-sm text-blue-700">
                    Solo puedes calificar los aspectos que te fueron asignados. Los puntajes no pueden superar el máximo permitido por criterio.
                </p>
            </div>
        </div>
{{-- Mostrar participante solo si se selecciona en el combo --}}
@if(request('search'))

    @if($participantes->count() == 0)

        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-6 rounded-xl text-center">
            <x-heroicon-o-user-group class="w-12 h-12 mx-auto mb-3 text-yellow-500" />
            Este concurso no tiene participantes registrados.
        </div>

    @elseif($concursoCriterios->count() == 0)

        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-6 rounded-xl text-center">
            <x-heroicon-o-clipboard-document-list class="w-12 h-12 mx-auto mb-3 text-yellow-500" />
            No tienes criterios asignados para calificar en este concurso.
        </div>

    @else

        <form action="{{ route('jurado.concursos.guardar', $concurso) }}" method="POST">
            <input type="hidden" name="page" value="{{ request('page', 1) }}">
            @csrf

            @foreach($participantes as $participante)

                <div class="bg-white rounded-2xl shadow-lg mb-8 overflow-hidden">

                    <div class="bg-gray-50 border-b p-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <x-heroicon-o-user class="w-6 h-6 text-green-600" />
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">
                                        {{ $participante->nombre }}
                                    </h3>
                                    @if($participante->cedula)
                                        <p class="text-sm text-gray-500">
                                            Cédula: {{ $participante->cedula }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-user class="w-4 h-4" />
                                Participante
                            </span>
                        </div>
                        @if($participante->descripcion)
                            <p class="text-sm text-gray-600 mt-4">
                                {{ $participante->descripcion }}
                            </p>
                        @endif
                    </div>

                    @foreach($concursoCriterios as $grupo)
                        @php
                            $aspecto = $grupo->first()->aspecto;
                        @endphp

                        <div class="p-5 border-b">
                            <h4 class="font-bold text-blue-700 mb-4 flex items-center gap-2">
                                <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
                                {{ $aspecto->nombre }}
                            </h4>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-50 border-b">
                                            <th class="p-4 text-left font-semibold text-gray-700">Criterio</th>
                                            <th class="p-4 text-left font-semibold text-gray-700">Máximo</th>
                                            <th class="p-4 text-left font-semibold text-gray-700">Puntaje</th>
                                            <th class="p-4 text-left font-semibold text-gray-700">Observación <span class="text-red-600">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grupo as $item)
                                            @php
                                                $key = $participante->id . '-' . $item->criterio_id;
                                                $evaluacion = $evaluaciones[$key] ?? null;
                                            @endphp
                                            <tr class="border-b hover:bg-gray-50">
                                                <td class="p-4">
                                                    <p class="font-semibold text-gray-800">{{ $item->criterio->nombre }}</p>
                                                    @if($item->criterio->descripcion)
                                                        <p class="text-sm text-gray-500 mt-1">{{ $item->criterio->descripcion }}</p>
                                                    @endif
                                                </td>
                                                <td class="p-4">
                                                    <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm font-semibold">
                                                        <x-heroicon-o-star class="w-4 h-4" />
                                                        {{ number_format($item->criterio->puntaje_maximo, 2) }}
                                                    </span>
                                                </td>
                                                <td class="p-4">
                                                    <input type="number"
                                                           step="0.01"
                                                           min="0"
                                                           max="{{ $item->criterio->puntaje_maximo }}"
                                                           name="puntajes[{{ $participante->id }}][{{ $item->criterio_id }}]"
                                                           value="{{ old('puntajes.' . $participante->id . '.' . $item->criterio_id, $evaluacion->puntaje ?? '') }}"
                                                           class="w-32 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                                                           required>
                                                </td>
                                                <td class="p-4">
                                                    <textarea name="observaciones[{{ $participante->id }}][{{ $item->criterio_id }}]"
                                                              class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500 text-black"
                                                              rows="2"
                                                              placeholder="Observación obligatoria"
                                                              required>{{ old('observaciones.' . $participante->id . '.' . $item->criterio_id, $evaluacion->observacion ?? '') }}</textarea>
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

            <div class="sticky bottom-0 bg-white/90 backdrop-blur border rounded-2xl shadow-lg p-4 flex flex-wrap gap-2 justify-between">
                <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
                    <x-heroicon-o-check class="w-5 h-5" />
                    Guardar calificación
                </button>
                <a href="{{ route('jurado.concursos.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">
                    <x-heroicon-o-arrow-left class="w-5 h-5" />
                    Volver
                </a>
            </div>
        </form>
    @endif
@endif


    </div>

</x-app-layout>