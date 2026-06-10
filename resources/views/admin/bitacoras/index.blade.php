<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <x-heroicon-o-document-text class="w-7 h-7 text-gray-700" />

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Bitácora del sistema
                    </h2>

                    <p class="text-sm text-gray-500">
                        Registro de acciones realizadas por los usuarios
                    </p>
                </div>
            </div>

            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $bitacoras->total() }} registros
            </span>

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow mb-6 p-4">

            <form method="GET" action="{{ route('bitacoras.index') }}">

                <div class="flex flex-col md:flex-row md:items-end gap-4">

                    <div class="flex-1">

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Buscar en bitácora
                        </label>

                        <div class="relative">
                            <x-heroicon-o-magnifying-glass
                                class="w-5 h-5 text-gray-400 absolute left-3 top-3" />

                            <input type="text"
                                   name="buscar"
                                   value="{{ request('buscar') }}"
                                   placeholder="Usuario, acción, módulo o detalle"
                                   class="w-full pl-10 pr-4 py-3 border-gray-300 rounded-xl focus:border-gray-600 focus:ring-gray-500">
                        </div>

                    </div>

                    <button class="inline-flex items-center justify-center gap-2 bg-gray-800 hover:bg-gray-900 text-white px-5 py-3 rounded-xl shadow">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                        Buscar
                    </button>

                    <a href="{{ route('bitacoras.index') }}"
                       class="inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                        Limpiar
                    </a>

                </div>

            </form>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Fecha
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Usuario
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Acción
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Módulo
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Detalle
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            IP
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @forelse($bitacoras as $bitacora)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4 text-gray-600">
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-clock class="w-4 h-4 text-gray-400" />
                                    {{ $bitacora->created_at->format('d/m/Y H:i') }}
                                </span>
                            </td>

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center">
                                        <x-heroicon-o-user class="w-5 h-5 text-gray-600" />
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $bitacora->usuario->name ?? 'Sistema' }}
                                        </p>

                                        @if($bitacora->usuario)
                                            <p class="text-xs text-gray-500">
                                                {{ $bitacora->usuario->email }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                            </td>

                            <td class="p-4">

                                @php
                                    $accionColor = match($bitacora->accion) {
                                        'CREAR' => 'bg-green-100 text-green-700',
                                        'EDITAR' => 'bg-yellow-100 text-yellow-700',
                                        'ELIMINAR' => 'bg-red-100 text-red-700',
                                        'CERRAR' => 'bg-gray-200 text-gray-800',
                                        'ASIGNAR' => 'bg-blue-100 text-blue-700',
                                        'EVALUAR' => 'bg-purple-100 text-purple-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp

                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $accionColor }}">
                                    {{ $bitacora->accion }}
                                </span>

                            </td>

                            <td class="p-4">
                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <x-heroicon-o-cube class="w-4 h-4" />
                                    {{ $bitacora->modulo }}
                                </span>
                            </td>

                            <td class="p-4 text-gray-700">
                                {{ $bitacora->detalle ?? '-' }}
                            </td>

                            <td class="p-4 text-gray-500">
                                {{ $bitacora->ip ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">
                                <x-heroicon-o-document-text class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                No hay registros en la bitácora.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $bitacoras->appends(request()->query())->links() }}
        </div>

    </div>

</x-app-layout>