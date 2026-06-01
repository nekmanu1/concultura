<x-app-layout>
    <x-slot name="header">
        @if(session('error'))
    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        {{ session('error') }}
    </div>
@endif
        <h2 class="text-xl font-semibold text-gray-800">
            Mis concursos asignados
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Concurso</th>
                        <th class="p-3 border">Categoría</th>
                        <th class="p-3 border">Fecha inicio</th>
                        <th class="p-3 border">Fecha fin</th>
                        <th class="p-3 border">Estado</th>
                        <th class="p-3 border">Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($concursos as $concurso)
                        <tr>
                            <td class="p-3 border">{{ $concurso->nombre }}</td>
                            <td class="p-3 border">{{ $concurso->categoria->nombre }}</td>
                            <td class="p-3 border">{{ $concurso->fecha_inicio ?? 'No definida' }}</td>
                            <td class="p-3 border">{{ $concurso->fecha_fin ?? 'No definida' }}</td>
                            <td class="p-3 border">{{ $concurso->estado }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('jurado.concursos.calificar', $concurso) }}"
                                   class="bg-blue-600 text-white px-3 py-2 rounded">
                                    Calificar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center">
                                No tienes concursos asignados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $concursos->links() }}
        </div>
    </div>
</x-app-layout>