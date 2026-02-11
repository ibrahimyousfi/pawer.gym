<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 overflow-hidden shadow-lg border border-zinc-800 sm:rounded-xl">
                <div class="p-6 text-zinc-300">
                    @if($trainingTypes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($trainingTypes as $type)
                                <div class="border border-zinc-800 bg-zinc-950 rounded-xl p-6 hover:border-orange-500/50 hover:shadow-orange-900/10 transition-all group">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-black uppercase italic tracking-tighter text-white">{{ $type->name }}</h3>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('training-types.edit', $type) }}" class="text-zinc-500 hover:text-orange-500 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('training-types.destroy', $type) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-zinc-500 hover:text-red-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-zinc-500 mb-6 text-sm line-clamp-2">{{ $type->description ?? 'No description' }}</p>

                                    <div class="flex justify-between items-center text-sm text-zinc-500 border-t border-zinc-800 pt-4 mt-auto">
                                        <span class="font-bold text-zinc-400">{{ $type->plans_count }} Plans</span>
                                        <a href="{{ route('training-types.show', $type) }}" class="text-orange-500 hover:text-orange-400 font-bold uppercase text-xs tracking-wider flex items-center gap-1 group-hover:gap-2 transition-all">
                                            Details <span>&rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-zinc-800 mb-4 text-zinc-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <p class="text-zinc-500 mb-4">No subscription types added yet.</p>
                            <a href="{{ route('training-types.create') }}" class="text-orange-500 hover:text-orange-400 font-bold uppercase tracking-wider">Start by adding the first type</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
