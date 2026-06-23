<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <x-heroicon-o-book-open class="w-7 h-7 text-blue-600" />

            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Guía del Jurado
                </h2>

                <p class="text-sm text-gray-500">
                    Información y pasos para realizar evaluaciones
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        {{-- BIENVENIDA --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">

            <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">

                <div class="flex items-center gap-4">

                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <x-heroicon-o-user-circle class="w-10 h-10 text-white" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold">
                            Bienvenido, {{ auth()->user()->name }}
                        </h1>

                        <p class="text-blue-100">
                            Jurado evaluador del sistema ConCultura
                        </p>
                    </div>

                </div>

            </div>

            <div class="p-6">

                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">

                    <div class="flex gap-3">
                        <x-heroicon-o-information-circle class="w-6 h-6 text-blue-600 flex-shrink-0" />

                        <p class="text-blue-700">
                            Como jurado, únicamente tendrás acceso a los concursos
                            que hayan sido asignados por un administrador.
                            Todas las evaluaciones realizadas quedarán registradas
                            automáticamente en el sistema.
                        </p>
                    </div>

                </div>

            </div>

        </div>

        {{-- PASOS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

            <div class="bg-white rounded-2xl shadow p-6">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-clipboard-document-list class="w-7 h-7 text-blue-600" />
                </div>

                <h3 class="font-bold text-gray-800 mb-2">
                    1. Revisar concursos
                </h3>

                <p class="text-sm text-gray-600">
                    Consulta los concursos que te fueron asignados para evaluación.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-users class="w-7 h-7 text-green-600" />
                </div>

                <h3 class="font-bold text-gray-800 mb-2">
                    2. Revisar participantes
                </h3>

                <p class="text-sm text-gray-600">
                    Analiza la información de cada participante y los recursos disponibles.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-pencil-square class="w-7 h-7 text-yellow-600" />
                </div>

                <h3 class="font-bold text-gray-800 mb-2">
                    3. Evaluar criterios
                </h3>

                <p class="text-sm text-gray-600">
                    Asigna puntajes y observaciones según los criterios establecidos.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <x-heroicon-o-check-badge class="w-7 h-7 text-purple-600" />
                </div>

                <h3 class="font-bold text-gray-800 mb-2">
                    4. Guardar evaluación
                </h3>

                <p class="text-sm text-gray-600">
                    Guarda tu evaluación para que quede registrada en el sistema.
                </p>
            </div>

        </div>

        {{-- RECOMENDACIONES --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <x-heroicon-o-light-bulb class="w-6 h-6 text-yellow-500" />
                Recomendaciones para la evaluación
            </h3>

            <ul class="space-y-3 text-gray-700">

                <li class="flex gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" />
                    Evalúe cada participante de forma objetiva e imparcial.
                </li>

                <li class="flex gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" />
                    Revise cuidadosamente todos los criterios asignados.
                </li>

                <li class="flex gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" />
                    Utilice las observaciones para justificar los puntajes otorgados.
                </li>

                <li class="flex gap-2">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" />
                    Verifique la información antes de guardar la evaluación.
                </li>

            </ul>

        </div>


    </div>

</x-app-layout>