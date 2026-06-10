<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-check-circle class="w-7 h-7 text-yellow-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Ver criterio
                </h2>

                <p class="text-sm text-gray-500">
                    Información detallada del criterio de evaluación
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- ENCABEZADO --}}
            <div class="bg-gradient-to-r from-yellow-600 to-amber-500 p-6 text-white">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <x-heroicon-o-check-circle class="w-8 h-8 text-white" />
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">
                                {{ $criterio->nombre }}
                            </h1>

                            <p class="text-yellow-100">
                                {{ $criterio->categoria->nombre }}
                            </p>
                        </div>

                    </div>

                    @if($criterio->estado)
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
                            {{ $criterio->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                            Categoría
                        </div>

                        <p class="font-semibold text-gray-800">
                            {{ $criterio->categoria->nombre }}
                        </p>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-star class="w-5 h-5" />
                            Puntaje máximo
                        </div>

                        <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-semibold">
                            <x-heroicon-o-star class="w-4 h-4" />
                            {{ number_format($criterio->puntaje_maximo, 2) }} puntos
                        </span>

                    </div>

                    <div class="bg-gray-50 border rounded-xl p-4">

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-1">
                            <x-heroicon-o-bolt class="w-5 h-5" />
                            Estado
                        </div>

                        @if($criterio->estado)
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

                        <p class="text-gray-800 leading-relaxed">
                            {{ $criterio->descripcion ?? 'Sin descripción registrada.' }}
                        </p>

                    </div>

                </div>

                {{-- TARJETA DE PUNTAJE --}}
                <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-200 rounded-xl p-5 mb-8">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                            <x-heroicon-o-trophy class="w-6 h-6 text-indigo-600" />
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Puntaje máximo permitido
                            </p>

                            <h3 class="text-2xl font-bold text-indigo-700">
                                {{ number_format($criterio->puntaje_maximo, 2) }}
                            </h3>
                        </div>

                    </div>

                </div>

                {{-- BOTONES --}}
                <div class="flex flex-wrap gap-2 border-t pt-6">

                    <a href="{{ route('criterios.edit', $criterio) }}"
                       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                        Editar criterio

                    </a>

                    <a href="{{ route('criterios.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                        <x-heroicon-o-arrow-left class="w-5 h-5" />
                        Volver

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>