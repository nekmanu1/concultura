<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl text-gray-800">
                        Concultura
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="flex items-center gap-1">
                            <x-heroicon-o-home class="w-4 h-4" />
                            Dashboard
                        </span>
                    </x-nav-link>

                    @if(auth()->user()->role === 'ADMINISTRADOR')

                        <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-users class="w-4 h-4" />
                                Usuarios
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                                Categorías
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('aspectos.index')" :active="request()->routeIs('aspectos.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-clipboard-document-list class="w-4 h-4" />
                                Aspectos
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('criterios.index')" :active="request()->routeIs('criterios.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-check-circle class="w-4 h-4" />
                                Criterios
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('concursos.index')" :active="request()->routeIs('concursos.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-trophy class="w-4 h-4" />
                                Concursos
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('bitacoras.index')" :active="request()->routeIs('bitacoras.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-document-text class="w-4 h-4" />
                                Bitácora
                            </span>
                        </x-nav-link>

                    @endif

                    @if(auth()->user()->role === 'JURADO')
                        <x-nav-link :href="route('jurado.concursos.index')" :active="request()->routeIs('jurado.concursos.*')">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-clipboard-document-check class="w-4 h-4" />
                                Mis concursos
                            </span>
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition">
                            <x-heroicon-o-user-circle class="w-5 h-5" />
                            <span>{{ Auth::user()->name }}</span>

                            <x-heroicon-o-chevron-down class="w-4 h-4" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <x-heroicon-o-bars-3 class="w-6 h-6" x-show="!open" />
                    <x-heroicon-o-x-mark class="w-6 h-6" x-show="open" />
                </button>
            </div>

        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'ADMINISTRADOR')

                <x-responsive-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')">
                    Usuarios
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.*')">
                    Categorías
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('aspectos.index')" :active="request()->routeIs('aspectos.*')">
                    Aspectos
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('criterios.index')" :active="request()->routeIs('criterios.*')">
                    Criterios
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('concursos.index')" :active="request()->routeIs('concursos.*')">
                    Concursos
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('bitacoras.index')" :active="request()->routeIs('bitacoras.*')">
                    Bitácora
                </x-responsive-nav-link>

            @endif

            @if(auth()->user()->role === 'JURADO')
                <x-responsive-nav-link :href="route('jurado.concursos.index')" :active="request()->routeIs('jurado.concursos.*')">
                    Mis concursos
                </x-responsive-nav-link>
            @endif

        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>

    </div>
</nav>