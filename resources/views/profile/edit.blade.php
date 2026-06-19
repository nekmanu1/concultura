<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfil de Usuario
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

            {{-- DOS TARJETAS ARRIBA --}}
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div>
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            {{-- ELIMINAR CUENTA ABAJO --}}
            <div class="mt-6">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                    <div class="bg-gradient-to-r from-red-700 to-red-500 p-6 text-white">

                        <div class="flex items-center gap-4">

                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <x-heroicon-o-trash class="w-8 h-8 text-white" />
                            </div>

                            <div>
                                <h2 class="text-2xl font-bold">
                                    Eliminar cuenta
                                </h2>

                                <p class="text-red-100">
                                    Esta acción es permanente y no podrá deshacerse.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>