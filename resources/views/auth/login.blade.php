<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center w-full px-4 py-6 sm:px-6">

        <div class="w-full max-w-xl bg-white rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-100 p-6 sm:p-8 md:p-10">

            {{-- LOGO --}}
            <div class="flex flex-col items-center mb-6">

                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo ConCultura"
                     class="w-40 sm:w-48 md:w-56 h-auto mb-4 sm:mb-5">

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center">
                    Sistema de Votación
                </h1>

                <p class="text-yellow-700 font-semibold text-center">
                    Ministerio de Cultura
                </p>

                <p class="text-gray-500 text-sm text-center mt-2">
                    Plataforma de evaluación, votación y resultados
                </p>

            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- USUARIO --}}
                <div class="mb-5">
                    <x-input-label
                        for="username"
                        :value="__('Usuario')"
                        class="text-gray-700 font-semibold"
                    />

                    <x-text-input
                        id="username"
                        class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-500 py-3 text-base"
                        type="text"
                        name="username"
                        :value="old('username')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Ingrese su usuario"
                    />

                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600" />
                </div>

                {{-- CONTRASEÑA --}}
                <div class="mb-6">
                    <x-input-label
                        for="password"
                        :value="__('Contraseña')"
                        class="text-gray-700 font-semibold"
                    />

                    <x-text-input
                        id="password"
                        class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-500 py-3 text-base"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingrese su contraseña"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                {{-- BOTÓN --}}
                <div class="mt-8">
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-yellow-700 hover:bg-yellow-800 text-white font-bold text-base sm:text-lg py-3 sm:py-4 px-4 rounded-xl shadow-lg transition duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M15 12H3m0 0l4-4m-4 4l4 4m6-10h5a2 2 0 012 2v8a2 2 0 01-2 2h-5" />
                        </svg>

                        Ingresar
                    </button>
                </div>

            </form>

            {{-- PIE --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-400">
                    © {{ date('Y') }} Ministerio de Cultura
                </p>
            </div>

        </div>

    </div>

</x-guest-layout>