@if(isset($pageTitle))
    <x-page-header 
        :title="$pageTitle" 
        :subtitle="$pageSubtitle ?? null"
        :action-url="$pageActionUrl ?? null"
        :action-label="$pageActionLabel ?? null"
        :show-action="$pageShowAction ?? false"
        :search-route="$pageSearchRoute ?? null"
        :search-placeholder="$pageSearchPlaceholder ?? 'Search...'"
        :show-search="$pageShowSearch ?? false"
        :filters="$pageFilters ?? null"
    />
@elseif(isset($header))
    <header class="bg-zinc-900 border-b border-zinc-800">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@else
    {{-- Default header if nothing is set --}}
    <x-page-header 
        title="Dashboard" 
        :show-action="false"
        :show-search="false"
    />
@endif
