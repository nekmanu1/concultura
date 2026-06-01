<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Panel de Jurado
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-2">
                Bienvenido, {{ auth()->user()->name }}
            </h3>

            <p class="text-gray-600 mb-6">
                Rol: {{ auth()->user()->role }}
            </p>

            <a href="{{ route('jurado.concursos.index') }}"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
                Ver concursos asignados
            </a>
        </div>
    </div>
</x-app-layout>