<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Bitácora del sistema
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6">

        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" action="{{ route('bitacoras.index') }}">
                <label class="block mb-1">Buscar</label>

                <div class="flex gap-2">
                    <input type="text"
                           name="buscar"
                           value="{{ request('buscar') }}"
                           placeholder="Usuario, acción, módulo o detalle"
                           class="w-full border-gray-300 rounded">

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Buscar
                    </button>

                    <a href="{{ route('bitacoras.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Fecha</th>
                        <th class="p-3 border">Usuario</th>
                        <th class="p-3 border">Acción</th>
                        <th class="p-3 border">Módulo</th>
                        <th class="p-3 border">Detalle</th>
                        <th class="p-3 border">IP</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bitacoras as $bitacora)
                        <tr>
                            <td class="p-3 border">
                                {{ $bitacora->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="p-3 border">
                                {{ $bitacora->usuario->name ?? 'Sistema' }}
                            </td>

                            <td class="p-3 border">
                                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                    {{ $bitacora->accion }}
                                </span>
                            </td>

                            <td class="p-3 border">
                                {{ $bitacora->modulo }}
                            </td>

                            <td class="p-3 border">
                                {{ $bitacora->detalle ?? '-' }}
                            </td>

                            <td class="p-3 border">
                                {{ $bitacora->ip ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center">
                                No hay registros en la bitácora.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $bitacoras->appends(request()->query())->links() }}
        </div>

    </div>
</x-app-layout>