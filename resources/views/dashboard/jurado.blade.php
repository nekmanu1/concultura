<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-clipboard-document-check class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Panel de Jurado
                </h2>

                <p class="text-sm text-gray-500">
                    Acceso a concursos asignados y evaluaciones
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">
                <div class="flex items-center gap-4">

                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user class="w-10 h-10 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Bienvenido, {{ auth()->user()->name }}
                        </h1>

                        <p class="text-blue-100">
                            Rol: {{ auth()->user()->role }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="p-6">

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                    <div class="flex gap-3">
                        <x-heroicon-o-information-circle class="w-6 h-6 text-blue-600 flex-shrink-0" />

                        <p class="text-sm text-blue-700">
                            Desde este panel podrás acceder únicamente a los concursos que te fueron asignados para evaluar.
                        </p>
                    </div>
                </div>

                <a href="{{ route('jurado.concursos.index') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
                    <x-heroicon-o-clipboard-document-check class="w-5 h-5" />
                    Ver concursos asignados
                </a>

            </div>

        </div>

    </div>

</x-app-layout>