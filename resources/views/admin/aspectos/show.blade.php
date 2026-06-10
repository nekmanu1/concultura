<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-purple-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ver aspecto
                </h2>
                <p class="text-sm text-gray-500">
                    Información detallada del aspecto de evaluación
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- ENCABEZADO --}}
            <div class="bg-gradient-to-r from-purple-700 to-purple-500 p-6 text-white">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <x-heroicon-o-clipboard-document-list class="w-8 h-8 text-white" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ $aspecto->nombre }}
                            </h1>

                            <p class="text-purple-100">
                                {{ $aspecto->categoria->nombre }}
                            </p>
                        </div>

                    </div>

                    @if($aspecto->estado)
                        <span class="inline-flex items-center gap-2 bg-white text-green-700 px-4 py-2 rounded-full font-semibold">
                            <x-heroicon-o-check-circle class="w-5 h-5" />
                            Activo
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 bg-white text-red-700 px-4 py-2 rounded-full font-semibold">
                            <x-heroicon-o-x-circle class="w-5 h-5" />
                            Inactivo
                        </span>
                    @endif

                </div>

            </div>

            {{-- CONTENIDO --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-tag class="w-5 h-5" />
                            Nombre
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $aspecto->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                            Categoría
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $aspecto->categoria->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-star class="w-5 h-5" />
                            Tipo de aspecto
                        </div>

                        @if($aspecto->es_general)
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-star class="w-4 h-4" />
                                General
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                Normal
                            </span>
                        @endif

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-bolt class="w-5 h-5" />
                            Estado
                        </div>

                        @if($aspecto->estado)
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-check-circle class="w-4 h-4" />
                                Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                <x-heroicon-o-x-circle class="w-4 h-4" />
                                Inactivo
                            </span>
                        @endif

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4 md:col-span-2">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-2">
                            <x-heroicon-o-document-text class="w-5 h-5" />
                            Descripción
                        </div>

                        <p class="text-gray-800">
                            {{ $aspecto->descripcion ?? 'Sin descripción registrada.' }}
                        </p>

                    </div>

                </div>

                {{-- INFORMACIÓN EXTRA --}}
                @if($aspecto->es_general)

                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">

                        <div class="flex items-start gap-3">

                            <x-heroicon-o-information-circle
                                class="w-6 h-6 text-blue-600 mt-0.5" />

                            <div>

                                <h4 class="font-semibold text-blue-700">
                                    Aspecto General
                                </h4>

                                <p class="text-blue-600 text-sm mt-1">
                                    Este aspecto fue creado automáticamente por el sistema
                                    y no puede ser eliminado.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif

                {{-- BOTONES --}}
                <div class="flex flex-wrap gap-2 border-t pt-6">

                    <a href="{{ route('aspectos.edit', $aspecto) }}"
                       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                        Editar aspecto

                    </a>

                    <a href="{{ route('aspectos.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                        <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Volver

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>