<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-users class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Asignar jurados
                </h2>

                <p class="text-sm text-gray-500">
                    Selecciona los jurados y los aspectos que podrán calificar
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

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $concurso->nombre }}
                        </h1>

                        <p class="text-blue-100 mt-1">
                            {{ $concurso->categoria->nombre }}
                        </p>
                    </div>

                    <span class="inline-flex items-center gap-2 bg-white text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                        <x-heroicon-o-users class="w-5 h-5" />
                        {{ count($juradosAsignados) }} jurados asignados
                    </span>

                </div>
            </div>

            <div class="p-6">
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex gap-3">
                    <x-heroicon-o-information-circle class="w-6 h-6 text-blue-600 flex-shrink-0" />

                    <p class="text-sm text-blue-700">
                        Marca los jurados que participarán en este concurso y selecciona los aspectos que podrá calificar cada uno.
                    </p>
                </div>
            </div>

        </div>

        <form action="{{ route('concursos.jurados.guardar', $concurso) }}" method="POST">
            @csrf

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <table class="w-full">

                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-center font-semibold text-gray-700">
                                Asignar
                            </th>

                            <th class="p-4 text-left font-semibold text-gray-700">
                                Jurado
                            </th>

                            <th class="p-4 text-left font-semibold text-gray-700">
                                Correo
                            </th>

                            <th class="p-4 text-left font-semibold text-gray-700">
                                Aspectos que calificará
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jurados as $jurado)
                            @php
                                $aspectosIds = isset($aspectosAsignados[$jurado->id])
                                    ? $aspectosAsignados[$jurado->id]->pluck('aspecto_id')->toArray()
                                    : [];
                            @endphp

                            <tr class="border-b hover:bg-gray-50 transition">

                                <td class="p-4 text-center">
                                    <input type="checkbox"
                                           name="jurados[]"
                                           value="{{ $jurado->id }}"
                                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                           {{ in_array($jurado->id, $juradosAsignados) ? 'checked' : '' }}>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <x-heroicon-o-user class="w-5 h-5 text-blue-600" />
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $jurado->name }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                ID: {{ $jurado->id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4 text-gray-600">
                                    <span class="inline-flex items-center gap-1">
                                        <x-heroicon-o-envelope class="w-4 h-4 text-gray-400" />
                                        {{ $jurado->email }}
                                    </span>
                                </td>

                                <td class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                        @foreach($aspectos as $aspecto)
                                            <label class="flex items-center gap-2 bg-gray-50 hover:bg-blue-50 border rounded-lg px-3 py-2 cursor-pointer">

                                                <input type="checkbox"
                                                       name="aspectos[{{ $jurado->id }}][]"
                                                       value="{{ $aspecto->id }}"
                                                       class="text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                       {{ in_array($aspecto->id, $aspectosIds) ? 'checked' : '' }}>

                                                <span class="text-sm text-gray-700">
                                                    {{ $aspecto->nombre }}
                                                </span>

                                                @if($aspecto->es_general)
                                                    <span class="ml-auto inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs font-semibold">
                                                        <x-heroicon-o-star class="w-3 h-3" />
                                                        General
                                                    </span>
                                                @endif

                                            </label>
                                        @endforeach
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500">
                                    <x-heroicon-o-users class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    No hay usuarios con rol JURADO registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            <div class="flex flex-wrap gap-2 mt-6">

                <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
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

    </div>

</x-app-layout>