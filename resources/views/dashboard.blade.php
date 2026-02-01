<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Warning Popup for Subscription Expiry -->
            @if(session('subscription_warning'))
                <div x-data="{ show: true }" x-show="show" class="fixed bottom-4 right-4 max-w-sm w-full bg-zinc-800 border border-orange-500 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden z-50">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-bold text-white">
                                    Attention !
                                </p>
                                <p class="mt-1 text-sm text-zinc-300">
                                    L'abonnement de votre salle expire dans {{ session('days_until_expiry') }} jours. Veuillez renouveler pour éviter toute interruption.
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button @click="show = false" class="bg-zinc-800 rounded-md inline-flex text-zinc-400 hover:text-zinc-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    <span class="sr-only">Fermer</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Member Statistics -->
            <div class="mb-6">
                <h3 class="text-lg font-black italic uppercase tracking-wider text-white mb-4">Aperçu des Membres</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    
                    <!-- Total Members -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-zinc-800 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Total Membres</p>
                                <p class="text-3xl font-black text-white mt-2">{{ $totalMembers }}</p>
                            </div>
                            <div class="bg-zinc-800 p-3 rounded-lg text-orange-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Active Members -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-emerald-900/20 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Actifs</p>
                                <p class="text-3xl font-black text-white mt-2">{{ $activeMembers }}</p>
                            </div>
                            <div class="bg-emerald-500/10 p-3 rounded-lg text-emerald-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Expired Members -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-red-900/20 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Expirés</p>
                                <p class="text-3xl font-black text-white mt-2">{{ $expiredMembers }}</p>
                            </div>
                            <div class="bg-red-500/10 p-3 rounded-lg text-red-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive Members -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-zinc-800 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Inactifs</p>
                                <p class="text-3xl font-black text-white mt-2">{{ $inactiveMembers }}</p>
                            </div>
                            <div class="bg-zinc-800 p-3 rounded-lg text-zinc-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Expiring Soon -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-16 h-16 bg-orange-900/20 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Expire Bientôt</p>
                                <p class="text-3xl font-black text-white mt-2">{{ $expiringSoon }}</p>
                                <p class="text-xs text-zinc-500 mt-1">(7 jours)</p>
                            </div>
                            <div class="bg-orange-500/10 p-3 rounded-lg text-orange-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Revenue Statistics -->
            <div class="mb-6">
                <h3 class="text-lg font-black italic uppercase tracking-wider text-white mb-4">Aperçu des Revenus</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    
                    <!-- Total Revenue -->
                    <div class="bg-gradient-to-br from-zinc-800 to-zinc-900 rounded-xl shadow-lg border border-zinc-700 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Revenu Total</p>
                                <p class="text-3xl font-black text-orange-500 mt-2">{{ number_format($totalRevenue, 2) }} MAD</p>
                            </div>
                            <div class="bg-orange-500/20 p-3 rounded-lg text-orange-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Subscription Revenue -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Abonnements</p>
                                <p class="text-3xl font-black text-white mt-2">{{ number_format($subscriptionRevenue, 2) }} MAD</p>
                            </div>
                            <div class="bg-zinc-800 p-3 rounded-lg text-zinc-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Product Revenue -->
                    <div class="bg-zinc-900 rounded-xl shadow-lg border border-zinc-800 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-zinc-400 font-bold uppercase tracking-wider">Produits</p>
                                <p class="text-3xl font-black text-white mt-2">{{ number_format($productRevenue, 2) }} MAD</p>
                            </div>
                            <div class="bg-zinc-800 p-3 rounded-lg text-zinc-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Recent Members -->
            <div class="bg-zinc-900 border border-zinc-800 shadow-lg rounded-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-black italic uppercase tracking-wider text-white mb-4">Derniers Membres</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b border-zinc-800">
                                <tr class="text-xs font-bold text-zinc-500 uppercase tracking-wider">
                                    <th class="pb-3 pl-4">Nom</th>
                                    <th class="pb-3">CIN</th>
                                    <th class="pb-3">Statut</th>
                                    <th class="pb-3">Plan</th>
                                    <th class="pb-3">Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800">
                                @forelse($recentMembers as $member)
                                <tr class="text-zinc-300 hover:bg-zinc-800/50 transition-colors">
                                    <td class="py-4 pl-4 font-bold text-white">{{ $member->full_name }}</td>
                                    <td class="py-4 text-sm">{{ $member->cin }}</td>
                                    <td class="py-4">
                                        @php $status = $member->status; @endphp
                                        <span class="px-2 py-1 text-xs font-black uppercase tracking-wider rounded-md
                                            {{ $status == 'Active' ? 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20' : 'bg-red-500/10 text-red-500 border border-red-500/20' }}
                                        ">
                                            {{ $status == 'Active' ? 'ACTIF' : 'INACTIF' }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-sm">
                                        {{ $member->activeSubscription?->plan?->name ?? 'Aucun' }}
                                    </td>
                                    <td class="py-4 text-sm text-zinc-500">
                                        {{ $member->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-zinc-500">Aucun membre trouvé</td>
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