<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center w-full bg-white">
        <div class="w-full max-w-md bg-white border border-gray-300 shadow-lg p-6 rounded-lg">
            <h2 class="text-center text-xl font-bold text-gray-800 mb-6">
                Concursos Culturales
            </h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-400 rounded-md shadow-sm focus:border-yellow-600 focus:ring focus:ring-yellow-200" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-400 rounded-md shadow-sm focus:border-yellow-600 focus:ring focus:ring-yellow-200" 
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" 
                        class="border-gray-400 text-yellow-600 focus:ring-yellow-500" 
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">
                        {{ __('Recordarme') }}
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-yellow-700 hover:text-yellow-900 font-medium" href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3 bg-yellow-700 hover:bg-yellow-800 text-white px-6 py-2 rounded-md shadow">
                        {{ __('Ingresar') }}
                    </x-primary-button>
                </div>
            </form>

            <div class="flex justify-center mt-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo ConCultura" class="w-29 h-auto opacity-80">
            </div>
        </div>
    </div>
</x-guest-layout>