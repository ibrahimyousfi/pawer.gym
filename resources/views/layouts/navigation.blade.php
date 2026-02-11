<nav x-data="{ mobileOpen: false }"
     x-ref="sidebar"
     @toggle-mobile-sidebar.window="mobileOpen = !mobileOpen"
     :class="$store.sidebar.open ? 'lg:w-64' : 'lg:w-16'"
     class="fixed left-0 top-0 h-screen bg-white border-r border-gray-200 z-40 transition-all duration-300 ease-in-out flex flex-col overflow-hidden w-0 lg:w-64">
    
    <!-- Mobile Overlay -->
    <div x-show="mobileOpen" 
         @click="mobileOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 z-30 lg:hidden"></div>

    <!-- Sidebar Content -->
    <div :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
         class="fixed lg:relative inset-y-0 left-0 w-64 lg:w-auto bg-white flex flex-col transition-transform duration-300 ease-in-out z-40">
        
        <!-- Logo Block -->
        <div class="h-16 flex items-center px-4 border-b border-gray-200 shrink-0">
            <button @click.stop="$store.sidebar.toggle()" 
                    class="flex items-center gap-3 w-full group hover:bg-gray-50 rounded-lg p-2 transition-colors">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span x-show="$store.sidebar.open" 
                      x-transition:enter="transition ease-out duration-200"
                      x-transition:enter-start="opacity-0 -translate-x-2"
                      x-transition:enter-end="opacity-100 translate-x-0"
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100 translate-x-0"
                      x-transition:leave-end="opacity-0 -translate-x-2"
                      class="text-lg font-bold text-blue-600 whitespace-nowrap">SubscriptionHub</span>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto py-2 px-2">
            <a href="{{ route('dashboard') }}"
               @click="mobileOpen = false"
               class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span x-show="$store.sidebar.open" 
                      x-transition:enter="transition ease-out duration-200"
                      x-transition:enter-start="opacity-0"
                      x-transition:enter-end="opacity-100"
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      class="ml-3 whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('members.index') }}"
               @click="mobileOpen = false"
               class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors mt-1 {{ request()->routeIs('members.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span x-show="$store.sidebar.open" 
                      x-transition:enter="transition ease-out duration-200"
                      x-transition:enter-start="opacity-0"
                      x-transition:enter-end="opacity-100"
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      class="ml-3 flex-1 whitespace-nowrap">Members</span>
                <div x-show="$store.sidebar.open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.stop
                     class="ml-auto flex gap-1">
                    <a href="{{ route('members.create') }}" 
                       @click="mobileOpen = false"
                       class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors text-xs shrink-0"
                       title="Add Member">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>
            </a>

            <a href="{{ route('training-types.index') }}"
               @click="mobileOpen = false"
               class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors mt-1 {{ request()->routeIs('training-types.*') || request()->routeIs('plans.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-show="$store.sidebar.open" 
                      x-transition:enter="transition ease-out duration-200"
                      x-transition:enter-start="opacity-0"
                      x-transition:enter-end="opacity-100"
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      class="ml-3 flex-1 whitespace-nowrap">Subscriptions</span>
                <div x-show="$store.sidebar.open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.stop
                     class="ml-auto flex gap-1">
                    <a href="{{ route('training-types.create') }}" 
                       @click="mobileOpen = false"
                       class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition-colors text-xs shrink-0"
                       title="Add Type">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- User Block (Bottom) -->
        <div class="border-t border-gray-200 p-4 mt-auto shrink-0">
            <div x-show="$store.sidebar.open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">System Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" @click.stop>
                    @csrf
                    <button type="submit" 
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div x-show="!$store.sidebar.open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="flex justify-center">
                <form method="POST" action="{{ route('logout') }}" @click.stop>
                    @csrf
                    <button type="submit" 
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
