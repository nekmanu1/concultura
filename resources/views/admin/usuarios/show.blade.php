<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Ver usuario
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <div class="bg-white p-6 rounded shadow">

            <p class="mb-3">
                <strong>Nombre:</strong> {{ $usuario->name }}
            </p>

            <p class="mb-3">
                <strong>Correo:</strong> {{ $usuario->email }}
            </p>

            <p class="mb-3">
                <strong>Rol:</strong> {{ $usuario->role }}
            </p>

            <div class="flex gap-2 mt-6">
                <a href="{{ route('usuarios.edit', $usuario) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Editar
                </a>

                <a href="{{ route('usuarios.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
    <x-heroicon-o-arrow-left class="w-5 h-5" />
                    Volver
                </a>
            </div>

        </div>
    </div>
</x-app-layout>