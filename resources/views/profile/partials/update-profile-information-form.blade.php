<section class="bg-white rounded-2xl shadow-lg overflow-hidden">

    {{-- CABECERA --}}
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">
        <div class="flex items-center gap-4">

            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <x-heroicon-o-user-circle class="w-8 h-8 text-white" />
            </div>

            <div>
                <h2 class="text-2xl font-bold">
                    Información del perfil
                </h2>

                <p class="text-blue-100">
                    Actualiza tu nombre y correo electrónico.
                </p>
            </div>

        </div>
    </div>

    <div class="p-6">

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <x-heroicon-o-user class="w-5 h-5 text-blue-600" />
                        Nombre
                    </label>

                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                        :value="old('name', $user->name)"
                        required
                        autofocus
                        autocomplete="name" />

                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <x-heroicon-o-envelope class="w-5 h-5 text-blue-600" />
                        Correo electrónico
                    </label>

                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500"
                        :value="old('email', $user->email)"
                        required
                        autocomplete="username" />

                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <div class="flex gap-3">
                                <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-yellow-600 flex-shrink-0" />

                                <div>
                                    <p class="text-sm text-yellow-700">
                                        Tu correo electrónico no está verificado.
                                    </p>

                                    <button
                                        form="send-verification"
                                        class="mt-2 text-sm font-semibold text-yellow-700 underline hover:text-yellow-800">
                                        Reenviar enlace de verificación
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-4 bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl">
                                Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                            </div>
                        @endif
                    @endif
                </div>

            </div>


            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">

                <div class="flex gap-3">

                    <x-heroicon-o-information-circle
                        class="w-6 h-6 text-blue-600 flex-shrink-0" />

                    <div>

                        <p class="font-semibold text-blue-700">
                            Importante
                        </p>

                        <p class="text-sm text-blue-600">
                             Mantén actualizada tu información para una correcta identificación dentro del sistema.
                        </p>

                    </div>

                </div>

            </div>

            <div class="flex flex-wrap items-center gap-4 mt-8 border-t pt-6">

                <button
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
                    <x-heroicon-o-check class="w-5 h-5" />
                    Guardar cambios
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="inline-flex items-center gap-2 text-sm text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-xl">
                        <x-heroicon-o-check-circle class="w-5 h-5" />
                        Cambios guardados correctamente.
                    </p>
                @endif

            </div>

        </form>

    </div>

</section>