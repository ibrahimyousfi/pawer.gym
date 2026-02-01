<nav x-data="{ open: false }" class="bg-zinc-900 border-b md:border-b-0 md:border-r border-zinc-800 md:w-72 md:min-h-screen md:flex md:flex-col flex-shrink-0">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 md:px-0 flex justify-between items-center h-20 md:h-auto md:block md:flex-1">

        <!-- Logo Section -->
        <div class="shrink-0 flex items-center md:h-24 md:justify-center md:border-b md:border-zinc-800 md:w-full">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group px-6 md:px-0">
                <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center shadow-lg shadow-orange-900/20 transition group-hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-2xl text-white font-black italic tracking-tighter uppercase block">POWER<span class="text-orange-500">GYM</span></span>
            </a>
        </div>

        <!-- Hamburger (Mobile Only) -->
        <div class="-me-2 flex items-center md:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 focus:outline-none transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Links (Desktop) -->
        <div class="hidden md:flex md:flex-col md:gap-2 md:p-6 md:w-full">
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-widest rounded-xl transition duration-200 group {{ request()->routeIs('dashboard') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20' : 'text-zinc-400 hover:text-white hover:bg-zinc-800 border border-transparent' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-orange-500' : 'text-zinc-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('members.index') }}"
               class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-widest rounded-xl transition duration-200 group {{ request()->routeIs('members.*') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20' : 'text-zinc-400 hover:text-white hover:bg-zinc-800 border border-transparent' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('members.*') ? 'text-orange-500' : 'text-zinc-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Membres
            </a>

            <a href="{{ route('training-types.index') }}"
               class="flex items-center px-4 py-3 text-sm font-bold uppercase tracking-widest rounded-xl transition duration-200 group {{ request()->routeIs('training-types.*') || request()->routeIs('plans.*') ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20' : 'text-zinc-400 hover:text-white hover:bg-zinc-800 border border-transparent' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('training-types.*') || request()->routeIs('plans.*') ? 'text-orange-500' : 'text-zinc-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Abonnements
            </a>
        </div>
    </div>

    <!-- User Profile Dropdown (Desktop - Bottom) -->
    <div class="hidden md:block border-t border-zinc-800 p-4 bg-zinc-900/50">
        <x-dropdown align="top" width="48" contentClasses="py-2 bg-zinc-800 border border-zinc-700 shadow-xl rounded-lg mb-2">
            <x-slot name="trigger">
                <button class="flex items-center w-full gap-3 px-3 py-2 rounded-lg text-left transition hover:bg-zinc-800 group">
                    <div class="w-10 h-10 rounded-lg bg-zinc-700 flex items-center justify-center border border-zinc-600 group-hover:border-orange-500 transition shrink-0">
                        <span class="text-orange-500 font-black">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-zinc-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <svg class="w-5 h-5 text-zinc-500 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="text-zinc-300 hover:bg-zinc-700 hover:text-orange-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ __('Profil') }}
                    </div>
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-400 hover:bg-red-500/10">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Se déconnecter') }}
                        </div>
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-zinc-900 border-t border-zinc-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-300 hover:text-orange-500 hover:bg-zinc-800">
                Tableau de bord
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('members.index')" :active="request()->routeIs('members.*')" class="text-zinc-300 hover:text-orange-500 hover:bg-zinc-800">
                Membres
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('training-types.index')" :active="request()->routeIs('training-types.*')" class="text-zinc-300 hover:text-orange-500 hover:bg-zinc-800">
                Abonnements
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-zinc-800">
            <div class="px-4">
                <div class="font-medium text-base text-zinc-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-zinc-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-zinc-400 hover:text-orange-500">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400">
                        {{ __('Se déconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
