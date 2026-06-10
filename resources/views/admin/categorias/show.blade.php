<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-squares-2x2 class="w-7 h-7 text-green-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ver categoría
                </h2>
                <p class="text-sm text-gray-500">
                    Información general y aspectos asociados
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-green-700 to-green-500 p-6 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <x-heroicon-o-squares-2x2 class="w-8 h-8 text-white" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ $categoria->nombre }}
                            </h1>

                            <p class="text-green-100">
                                Categoría del sistema de votación
                            </p>
                        </div>
                    </div>

                    @if($categoria->estado)
                        <span class="inline-flex items-center gap-1 bg-white text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <x-heroicon-o-check-circle class="w-5 h-5" />
                            Activa
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 bg-white text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <x-heroicon-o-x-circle class="w-5 h-5" />
                            Inactiva
                        </span>
                    @endif

                </div>
            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <div class="bg-gray-50 border rounded-xl p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-identification class="w-5 h-5" />
                            Nombre
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $categoria->nombre }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
                            Aspectos registrados
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $categoria->aspectos->count() }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4 md:col-span-2">
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-document-text class="w-5 h-5" />
                            Descripción
                        </div>

                        <p class="font-medium text-gray-800">
                            {{ $categoria->descripcion ?? 'Sin descripción' }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">
                        Aspectos de esta categoría
                    </h3>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $categoria->aspectos->count() }} aspectos
                    </span>
                </div>

                <div class="bg-white border rounded-xl overflow-hidden mb-8">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="p-4 text-left font-semibold text-gray-700">
                                    Aspecto
                                </th>
                                <th class="p-4 text-left font-semibold text-gray-700">
                                    General
                                </th>
                                <th class="p-4 text-left font-semibold text-gray-700">
                                    Estado
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($categoria->aspectos as $aspecto)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-purple-100 rounded-full flex items-center justify-center">
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center text-gray-500">
                                        <x-heroicon-o-clipboard-document-list class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                        No hay aspectos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap gap-2 border-t pt-6">

                    <a href="{{ route('categorias.edit', $categoria) }}"
                       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                        Editar categoría
                    </a>

                    <a href="{{ route('categorias.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                        <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Volver
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>