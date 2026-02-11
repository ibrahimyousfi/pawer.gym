@props([
    'title',
    'subtitle' => null,
    'actionUrl' => null,
    'actionLabel' => null,
    'showAction' => false,
    'searchRoute' => null,
    'searchPlaceholder' => 'Search...',
    'showSearch' => false,
    'filters' => null
])

<header class="h-14 lg:h-16 bg-white border-b border-gray-200 shadow-sm sticky top-0 lg:top-0 z-20">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 h-full flex items-center gap-2 lg:gap-4">
        <!-- Left: Page Title -->
        <div class="flex items-center gap-2 lg:gap-3 shrink-0 min-w-0">
            <h1 class="text-base lg:text-xl font-bold text-gray-900 truncate">{{ $title }}</h1>
            @if($subtitle)
                <span class="hidden sm:inline-flex px-2 lg:px-3 py-1 text-xs lg:text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">{{ $subtitle }}</span>
            @endif
        </div>

        <!-- Center: Search and Filter -->
        @if($showSearch && $searchRoute)
            <div class="flex-1 flex items-center justify-center gap-2 lg:gap-3 px-2 lg:px-4 min-w-0">
                <!-- Search Input -->
                <form method="GET" action="{{ $searchRoute }}" class="w-full max-w-xs lg:max-w-md">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="{{ $searchPlaceholder }}" 
                               class="w-full pl-8 lg:pl-9 pr-3 py-1.5 lg:py-2 text-xs lg:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <div class="absolute inset-y-0 left-0 pl-2 lg:pl-3 flex items-center pointer-events-none">
                            <svg class="h-3.5 w-3.5 lg:h-4 lg:w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        @if(request('search'))
                            <a href="{{ $searchRoute }}" class="absolute inset-y-0 right-0 pr-2 lg:pr-3 flex items-center hover:text-gray-600 transition">
                                <svg class="h-3.5 w-3.5 lg:h-4 lg:w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Filter Dropdown -->
                @if($filters && count($filters) > 0)
                    <div x-data="{ open: false }" class="relative shrink-0">
                        <button @click="open = !open" 
                                class="p-1.5 lg:p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </button>
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-72 lg:w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 p-3 lg:p-4">
                            <h3 class="text-xs lg:text-sm font-semibold text-gray-900 mb-2 lg:mb-3">Filters</h3>
                            <div class="space-y-1 max-h-64 overflow-y-auto">
                                @foreach($filters as $filter)
                                    <a href="{{ $filter['url'] }}" 
                                       class="block px-2 lg:px-3 py-1.5 lg:py-2 text-xs lg:text-sm rounded-lg transition-colors {{ $filter['active'] ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                        {{ $filter['label'] }}
                                        @if(isset($filter['count']))
                                            <span class="text-gray-500">({{ $filter['count'] }})</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-3 lg:mt-4 pt-3 lg:pt-4 border-t border-gray-200">
                                <a href="{{ $searchRoute }}" class="block w-full px-3 lg:px-4 py-1.5 lg:py-2 bg-gray-100 text-gray-800 text-xs lg:text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors text-center">Reset</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="flex-1"></div>
        @endif

        <!-- Right: Action Button -->
        @if($showAction && $actionUrl && $actionLabel)
            <div class="shrink-0">
                <a href="{{ $actionUrl }}" 
                   class="w-7 h-7 lg:w-8 lg:h-8 border border-blue-200 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</header>
