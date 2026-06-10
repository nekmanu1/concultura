<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <x-heroicon-o-user-group class="w-7 h-7 text-green-600" />

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Participantes
                    </h2>

                    <p class="text-sm text-gray-500">
                        Gestión de participantes registrados por concurso
                    </p>
                </div>
            </div>

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $participantes->total() }} participantes
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

            <form method="GET" action="{{ route('participantes.index') }}">
                <div class="flex flex-col md:flex-row md:items-end gap-4">

                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Filtrar por concurso
                        </label>

                        <select name="concurso_id"
                                class="w-full border-gray-300 rounded-xl focus:border-green-500 focus:ring-green-500">
                            <option value="">Todos los concursos</option>

                            @foreach($concursos as $concurso)
                                <option value="{{ $concurso->id }}" {{ $concursoId == $concurso->id ? 'selected' : '' }}>
                                    {{ $concurso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                        Filtrar
                    </button>

                    <a href="{{ route('participantes.index') }}"
                       class="inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                        Limpiar
                    </a>

                    <a href="{{ route('participantes.create', ['concurso_id' => $concursoId]) }}"
                       class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
                        <x-heroicon-o-plus class="w-5 h-5" />
                        Crear participante
                    </a>

                </div>
            </form>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Participante
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Cédula
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Concurso
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Contacto
                        </th>

                        <th class="p-4 text-center font-semibold text-gray-700">
                            Acciones
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @forelse($participantes as $participante)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <x-heroicon-o-user class="w-5 h-5 text-green-600" />
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $participante->nombre }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ID: {{ $participante->id }}
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="p-4">
                                <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <x-heroicon-o-identification class="w-4 h-4" />
                                    {{ $participante->cedula ?? 'No registrada' }}
                                </span>
                            </td>

                            <td class="p-4 text-gray-700">
                                {{ $participante->concurso->nombre }}
                            </td>

                            <td class="p-4">
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p class="flex items-center gap-1">
                                        <x-heroicon-o-phone class="w-4 h-4 text-gray-400" />
                                        {{ $participante->telefono ?? 'No registrado' }}
                                    </p>

                                    <p class="flex items-center gap-1">
                                        <x-heroicon-o-envelope class="w-4 h-4 text-gray-400" />
                                        {{ $participante->correo ?? 'No registrado' }}
                                    </p>
                                </div>
                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('participantes.show', $participante) }}"
                                       class="inline-flex items-center gap-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>

                                    @if($participante->concurso->estado !== 'CERRADO')
                                        <a href="{{ route('participantes.edit', $participante) }}"
                                           class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-lg">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </a>

                                        <form action="{{ route('participantes.destroy', $participante) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este participante?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg">
                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>

                                        </form>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-400 px-3 py-2 rounded-lg cursor-not-allowed"
                                              title="El concurso está cerrado">
                                            <x-heroicon-o-lock-closed class="w-4 h-4" />
                                        </span>
                                    @endif

                                </div>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                <x-heroicon-o-user-group class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                No hay participantes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $participantes->appends(request()->query())->links() }}
        </div>



    </div>

</x-app-layout>