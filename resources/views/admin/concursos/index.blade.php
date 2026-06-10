<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <x-heroicon-o-trophy class="w-7 h-7 text-red-600" />

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Concursos
                    </h2>

                    <p class="text-sm text-gray-500">
                        Administración de concursos de evaluación
                    </p>
                </div>
            </div>

            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $concursos->total() }} concursos
            </span>

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

        <div class="bg-white rounded-2xl shadow mb-6 p-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h3 class="font-bold text-gray-800">
                        Listado de concursos
                    </h3>

                    <p class="text-sm text-gray-500">
                        Desde aquí puedes crear concursos, asignar criterios, participantes y jurados.
                    </p>
                </div>

                <a href="{{ route('concursos.create') }}"
                   class="inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

                    <x-heroicon-o-plus class="w-5 h-5" />

                    Crear concurso
                </a>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Concurso
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Categoría
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Inicio
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Fin
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Estado
                        </th>

                        <th class="p-4 text-center font-semibold text-gray-700">
                            Acciones
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($concursos as $concurso)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <x-heroicon-o-trophy class="w-5 h-5 text-red-600" />
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $concurso->nombre }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ID: {{ $concurso->id }}
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="p-4 text-gray-700">
                                {{ $concurso->categoria->nombre }}
                            </td>

                            <td class="p-4 text-gray-600">
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-calendar-days class="w-4 h-4 text-gray-400" />
                                    {{ $concurso->fecha_inicio ?? 'No definida' }}
                                </span>
                            </td>

                            <td class="p-4 text-gray-600">
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-calendar-days class="w-4 h-4 text-gray-400" />
                                    {{ $concurso->fecha_fin ?? 'No definida' }}
                                </span>
                            </td>

                            <td class="p-4">

                                @if($concurso->estado === 'ACTIVO')
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-play-circle class="w-4 h-4" />
                                        Activo
                                    </span>
                                @elseif($concurso->estado === 'CERRADO')
                                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-lock-closed class="w-4 h-4" />
                                        Cerrado
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        Borrador
                                    </span>
                                @endif

                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('concursos.show', $concurso) }}"
                                       class="inline-flex items-center gap-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>

                                    @if($concurso->estado !== 'CERRADO')
                                        <a href="{{ route('concursos.edit', $concurso) }}"
                                           class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-lg">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('concursos.destroy', $concurso) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este concurso?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg">
                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>

                                        </form>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-400 px-3 py-2 rounded-lg cursor-not-allowed"
                                              title="El concurso cerrado no se puede editar ni eliminar">
                                            <x-heroicon-o-lock-closed class="w-4 h-4" />
                                        </span>
                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">

                                <x-heroicon-o-trophy
                                    class="w-10 h-10 mx-auto mb-3 text-gray-300" />

                                No hay concursos registrados.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $concursos->links() }}
        </div>

    </div>

</x-app-layout>