<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver participante
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3"><strong>Nombre:</strong> {{ $participante->nombre }}</p>
            <p class="mb-3"><strong>Cédula:</strong> {{ $participante->cedula ?? 'No registrada' }}</p>
            <p class="mb-3"><strong>Concurso:</strong> {{ $participante->concurso->nombre }}</p>
            <p class="mb-3"><strong>Teléfono:</strong> {{ $participante->telefono ?? 'No registrado' }}</p>
            <p class="mb-3"><strong>Correo:</strong> {{ $participante->correo ?? 'No registrado' }}</p>
            <p class="mb-3"><strong>Descripción:</strong> {{ $participante->descripcion ?? 'Sin descripción' }}</p>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('participantes.edit', $participante) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('participantes.index', ['concurso_id' => $participante->concurso_id]) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded">
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>