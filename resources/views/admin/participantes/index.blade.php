<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Participantes
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" action="{{ route('participantes.index') }}">
                <label class="block mb-1">Filtrar por concurso</label>

                <div class="flex gap-2">
                    <select name="concurso_id" class="w-full border-gray-300 rounded">
                        <option value="">Todos los concursos</option>
                        @foreach($concursos as $concurso)
                            <option value="{{ $concurso->id }}" {{ $concursoId == $concurso->id ? 'selected' : '' }}>
                                {{ $concurso->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <div class="mb-4">
            <a href="{{ route('participantes.create', ['concurso_id' => $concursoId]) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Crear participante
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nombre</th>
                        <th class="p-3 border">Cédula</th>
                        <th class="p-3 border">Concurso</th>
                        <th class="p-3 border">Teléfono</th>
                        <th class="p-3 border">Correo</th>
                        <th class="p-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participantes as $participante)
                        <tr>
                            <td class="p-3 border">{{ $participante->nombre }}</td>
                            <td class="p-3 border">{{ $participante->cedula ?? 'No registrada' }}</td>
                            <td class="p-3 border">{{ $participante->concurso->nombre }}</td>
                            <td class="p-3 border">{{ $participante->telefono ?? 'No registrado' }}</td>
                            <td class="p-3 border">{{ $participante->correo ?? 'No registrado' }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('participantes.show', $participante) }}" class="text-blue-600">
                                    Ver
                                </a>

                                <a href="{{ route('participantes.edit', $participante) }}" class="text-yellow-600 ml-3">
                                    Editar
                                </a>

                                <form action="{{ route('participantes.destroy', $participante) }}"
                                      method="POST"
                                      class="inline ml-3"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este participante?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center">
                                No hay participantes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $participantes->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>