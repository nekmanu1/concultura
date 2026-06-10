<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">
                <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-purple-600" />

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Aspectos
                    </h2>

                    <p class="text-sm text-gray-500">
                        Secciones donde se agrupan los criterios de evaluación
                    </p>
                </div>
            </div>

            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $aspectos->total() }} aspectos
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
                        Listado de aspectos
                    </h3>

                    <p class="text-sm text-gray-500">
                        El aspecto general de cada categoría no puede eliminarse.
                    </p>
                </div>

                <a href="{{ route('aspectos.create') }}"
                   class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl shadow">

                    <x-heroicon-o-plus class="w-5 h-5" />

                    Crear aspecto
                </a>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">

                <thead>
                    <tr class="bg-gray-50 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Aspecto
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Categoría
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Tipo
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

                    @forelse($aspectos as $aspecto)

                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-purple-600" />
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $aspecto->nombre }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ID: {{ $aspecto->id }}
                                        </p>
                                    </div>

                                </div>

                            </td>

                            <td class="p-4 text-gray-700">
                                {{ $aspecto->categoria->nombre }}
                            </td>

                            <td class="p-4">

                                @if($aspecto->es_general)
                                    <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-star class="w-4 h-4" />
                                        General
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Normal
                                    </span>
                                @endif

                            </td>

                            <td class="p-4">

                                @if($aspecto->estado)
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-check-circle class="w-4 h-4" />
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <x-heroicon-o-x-circle class="w-4 h-4" />
                                        Inactivo
                                    </span>
                                @endif

                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('aspectos.show', $aspecto) }}"
                                       class="inline-flex items-center gap-1 bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-2 rounded-lg">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>

                                    <a href="{{ route('aspectos.edit', $aspecto) }}"
                                       class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-2 rounded-lg">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </a>

                                    @if(!$aspecto->es_general)

                                        <form action="{{ route('aspectos.destroy', $aspecto) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este aspecto?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-lg">
                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>

                                        </form>

                                    @else

                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-400 px-3 py-2 rounded-lg cursor-not-allowed"
                                              title="El aspecto general no se puede eliminar">
                                            <x-heroicon-o-lock-closed class="w-4 h-4" />
                                        </span>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">

                                <x-heroicon-o-clipboard-document-list
                                    class="w-10 h-10 mx-auto mb-3 text-gray-300" />

                                No hay aspectos registrados.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $aspectos->links() }}
        </div>

    </div>

</x-app-layout>