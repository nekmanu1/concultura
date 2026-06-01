<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Asignar jurados
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
                Marca los jurados que participarán en este concurso y selecciona los aspectos que podrá calificar cada uno.
            </p>
        </div>

        <form action="{{ route('concursos.jurados.guardar', $concurso) }}" method="POST">
            @csrf

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 border">Asignar</th>
                            <th class="p-3 border">Jurado</th>
                            <th class="p-3 border">Correo</th>
                            <th class="p-3 border">Aspectos que calificará</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jurados as $jurado)
                            @php
                                $aspectosIds = isset($aspectosAsignados[$jurado->id])
                                    ? $aspectosAsignados[$jurado->id]->pluck('aspecto_id')->toArray()
                                    : [];
                            @endphp

                            <tr>
                                <td class="p-3 border text-center">
                                    <input type="checkbox"
                                           name="jurados[]"
                                           value="{{ $jurado->id }}"
                                           {{ in_array($jurado->id, $juradosAsignados) ? 'checked' : '' }}>
                                </td>

                                <td class="p-3 border">
                                    {{ $jurado->name }}
                                </td>

                                <td class="p-3 border">
                                    {{ $jurado->email }}
                                </td>

                                <td class="p-3 border">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                        @foreach($aspectos as $aspecto)
                                            <label class="flex items-center gap-2">
                                                <input type="checkbox"
                                                       name="aspectos[{{ $jurado->id }}][]"
                                                       value="{{ $aspecto->id }}"
                                                       {{ in_array($aspecto->id, $aspectosIds) ? 'checked' : '' }}>

                                                <span>
                                                    {{ $aspecto->nombre }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center">
                                    No hay usuarios con rol JURADO registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex gap-2 mt-6">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Guardar asignación
                </button>

                <a href="{{ route('concursos.show', $concurso) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Volver
                </a>
            </div>
        </form>
    </div>
</x-app-layout>