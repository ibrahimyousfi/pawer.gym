<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-black italic uppercase tracking-tighter text-3xl text-white leading-tight">
                {{ __('Gestion des Membres') }}
            </h2>
            <a href="{{ route('members.create', ['training_type_id' => request('training_type_id')]) }}" class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold uppercase tracking-wider rounded-lg shadow-lg shadow-orange-900/20 transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un Membre
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filters & Search -->
            <div class="mb-6 bg-zinc-900 border border-zinc-800 rounded-xl shadow-lg p-6">
                <div class="flex flex-col lg:flex-row gap-6 justify-between items-start lg:items-center">
                    <!-- Filters Grid -->
                    <div class="flex flex-col gap-4 w-full lg:w-3/4">
                        <!-- Status Filters -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-bold text-zinc-500 uppercase tracking-wider mr-2">Statut:</span>
                            <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" 
                               class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ !request('status') || request('status') == 'all' ? 'bg-zinc-800 text-white border border-zinc-700' : 'bg-transparent text-zinc-500 hover:text-white hover:bg-zinc-800' }}">
                                Tous ({{ $counts['status']['all'] }})
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" 
                               class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ request('status') == 'active' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-transparent text-zinc-500 hover:text-emerald-500 hover:bg-emerald-500/10' }}">
                                Actif ({{ $counts['status']['active'] }})
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'expired']) }}" 
                               class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ request('status') == 'expired' ? 'bg-red-500/10 text-red-500 border border-red-500/20' : 'bg-transparent text-zinc-500 hover:text-red-500 hover:bg-red-500/10' }}">
                                Expiré ({{ $counts['status']['expired'] }})
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'inactive']) }}" 
                               class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ request('status') == 'inactive' ? 'bg-zinc-800 text-zinc-400 border border-zinc-700' : 'bg-transparent text-zinc-500 hover:text-zinc-400 hover:bg-zinc-800' }}">
                                Inactif ({{ $counts['status']['inactive'] }})
                            </a>
                        </div>

                        <!-- Discipline Filters -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-bold text-zinc-500 uppercase tracking-wider mr-2">Discipline:</span>
                            <a href="{{ request()->fullUrlWithQuery(['training_type_id' => '']) }}" 
                               class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ !request('training_type_id') ? 'bg-zinc-800 text-white border border-zinc-700' : 'bg-transparent text-zinc-500 hover:text-white hover:bg-zinc-800' }}">
                                Tous ({{ $counts['training_type']['all'] }})
                            </a>
                            @foreach($trainingTypes as $type)
                                <a href="{{ request()->fullUrlWithQuery(['training_type_id' => $type->id]) }}" 
                                   class="px-4 py-1.5 text-sm rounded-lg font-bold uppercase tracking-wider transition {{ request('training_type_id') == $type->id ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20' : 'bg-transparent text-zinc-500 hover:text-orange-500 hover:bg-orange-500/10' }}">
                                    {{ $type->name }} ({{ $counts['training_type'][$type->id] ?? 0 }})
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Search -->
                    <form method="GET" action="{{ route('members.index') }}" class="w-full lg:w-auto flex">
                        @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                        @if(request('training_type_id')) <input type="hidden" name="training_type_id" value="{{ request('training_type_id') }}"> @endif
                        <input type="text" 
                               name="search" 
                               placeholder="Rechercher..." 
                               value="{{ request('search') }}" 
                               class="flex-1 lg:w-64 rounded-l-lg bg-zinc-950 border-zinc-800 text-white focus:border-orange-500 focus:ring-orange-500 shadow-inner px-4 py-2">
                        <button type="submit" class="px-6 py-2 bg-zinc-800 text-zinc-400 border border-l-0 border-zinc-800 rounded-r-lg hover:bg-zinc-700 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Members Grid/Table -->
            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-lg rounded-xl">
                <div class="p-6">
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-zinc-800">
                                <tr class="text-left text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    <th class="pb-4 pl-4">Membre</th>
                                    <th class="pb-4">Contact</th>
                                    <th class="pb-4">Statut</th>
                                    <th class="pb-4">Abonnement Actuel</th>
                                    <th class="pb-4">Expire le</th>
                                    <th class="pb-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800">
                                @forelse($members as $member)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <!-- Member Info with Photo -->
                                    <td class="py-4 pl-4">
                                        <div class="flex items-center gap-3">
                                            @if($member->photo_path)
                                                <img src="{{ asset('uploads/' . $member->photo_path) }}" 
                                                     class="w-12 h-12 rounded-xl object-cover border-2 border-zinc-800" 
                                                     alt="{{ $member->full_name }}">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-zinc-800 flex items-center justify-center border-2 border-zinc-700">
                                                    <span class="text-zinc-400 font-black text-lg">
                                                        {{ substr($member->full_name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-white">{{ $member->full_name }}</div>
                                                <div class="text-xs text-zinc-500 font-mono">CIN: {{ $member->cin }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Contact -->
                                    <td class="py-4">
                                        <div class="text-sm text-zinc-300 font-mono">{{ $member->phone ?? 'N/A' }}</div>
                                        <div class="text-xs text-zinc-500 capitalize">{{ $member->gender == 'male' ? 'Homme' : 'Femme' }}</div>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-4">
                                        @php $status = $member->status; @endphp
                                        <span class="px-2 py-1 text-xs font-bold uppercase tracking-wider rounded-md
                                            {{ $status == 'Active' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : '' }}
                                            {{ $status == 'Expired' ? 'bg-red-500/10 text-red-500 border border-red-500/20' : '' }}
                                            {{ $status == 'Inactive' ? 'bg-zinc-800 text-zinc-500 border border-zinc-700' : '' }}
                                        ">
                                            @if($status == 'Active') ACTIF
                                            @elseif($status == 'Expired') EXPIRÉ
                                            @else INACTIF
                                            @endif
                                        </span>
                                    </td>

                                    <!-- Current Plan -->
                                    <td class="py-4">
                                        @php $activeSub = $member->subscriptions->where('end_date', '>=', now()->toDateString())->first(); @endphp
                                        @if($activeSub)
                                            <div class="text-sm font-bold text-white">{{ $activeSub->plan->name }}</div>
                                            <div class="text-xs text-zinc-500">{{ $activeSub->plan->trainingType->name }}</div>
                                        @else
                                            <span class="text-zinc-600 text-sm italic">Aucun plan actif</span>
                                        @endif
                                    </td>

                                    <!-- Expiration -->
                                    <td class="py-4">
                                        @if($activeSub)
                                            @php 
                                                $daysLeft = now()->diffInDays($activeSub->end_date, false);
                                                $isExpiringSoon = $daysLeft <= 7 && $daysLeft >= 0;
                                            @endphp
                                            <div class="text-sm font-mono {{ $isExpiringSoon ? 'text-orange-500 font-bold' : 'text-zinc-300' }}">
                                                {{ $activeSub->end_date->format('d/m/Y') }}
                                            </div>
                                            <div class="text-xs {{ $isExpiringSoon ? 'text-orange-500' : 'text-zinc-500' }}">
                                                ({{ $daysLeft }} jours restants)
                                            </div>
                                        @else
                                            <span class="text-zinc-600 text-sm">-</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- WhatsApp -->
                                            @if($member->phone)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" 
                                               target="_blank"
                                               class="p-2 text-zinc-400 hover:text-emerald-500 hover:bg-emerald-500/10 rounded-lg transition" 
                                               title="WhatsApp">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                                </svg>
                                            </a>
                                            @endif

                                            <!-- View -->
                                            <a href="{{ route('members.show', $member) }}" 
                                               class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition" 
                                               title="Voir Détails">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('members.edit', $member) }}" 
                                               class="p-2 text-zinc-400 hover:text-orange-500 hover:bg-orange-500/10 rounded-lg transition" 
                                               title="Éditer">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-zinc-500">
                                        Aucun membre trouvé. Commencez par en ajouter un !
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>