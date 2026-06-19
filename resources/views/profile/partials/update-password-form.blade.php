<section class="bg-white rounded-2xl shadow-lg overflow-hidden">

    {{-- CABECERA --}}
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 p-6 text-white">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <x-heroicon-o-lock-closed class="w-8 h-8 text-white" />
            </div>

            <div>
                <h2 class="text-2xl font-bold">
                    Cambiar contraseña
                </h2>

                <p class="text-blue-100">
                    Mantén tu cuenta protegida utilizando una contraseña segura.
                </p>
            </div>

        </div>

    </div>

    {{-- FORMULARIO --}}
    <div class="p-6">

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- CONTRASEÑA ACTUAL --}}
                <div class="md:col-span-2">

                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <x-heroicon-o-key class="w-5 h-5 text-blue-600" />
                        Contraseña actual
                    </label>

                    <x-text-input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error
                        :messages="$errors->updatePassword->get('current_password')"
                        class="mt-2" />

                </div>

                {{-- NUEVA CONTRASEÑA --}}
                <div>

                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <x-heroicon-o-lock-closed class="w-5 h-5 text-blue-600" />
                        Nueva contraseña
                    </label>

                    <x-text-input
                        id="update_password_password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error
                        :messages="$errors->updatePassword->get('password')"
                        class="mt-2" />

                </div>

                {{-- CONFIRMAR --}}
                <div>

                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <x-heroicon-o-shield-check class="w-5 h-5 text-blue-600" />
                        Confirmar contraseña
                    </label>

                    <x-text-input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="w-full border-gray-300 rounded-xl focus:border-blue-500 focus:ring-blue-500" />

                    <x-input-error
                        :messages="$errors->updatePassword->get('password_confirmation')"
                        class="mt-2" />

                </div>

            </div>

            {{-- RECOMENDACIÓN --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">

                <div class="flex gap-3">

                    <x-heroicon-o-information-circle
                        class="w-6 h-6 text-blue-600 flex-shrink-0" />

                    <div>

                        <p class="font-semibold text-blue-700">
                            Recomendación de seguridad
                        </p>

                        <p class="text-sm text-blue-600">
                            Utiliza una contraseña de al menos 8 caracteres,
                            combinando letras mayúsculas, minúsculas, números
                            y caracteres especiales.
                        </p>

                    </div>

                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex flex-wrap items-center gap-4 mt-8 border-t pt-6">

                <button
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                    <x-heroicon-o-check class="w-5 h-5" />

                    Actualizar contraseña

                </button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2500)"
                        class="inline-flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-xl">

                        <x-heroicon-o-check-circle class="w-5 h-5" />

                        Contraseña actualizada correctamente.

                    </p>
                @endif

            </div>

        </form>

    </div>

</section>