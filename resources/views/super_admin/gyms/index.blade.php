<x-super-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Salles de Sport</h1>
                <p class="text-gray-500 mt-1">Gérer toutes les salles de sport enregistrées</p>
            </div>
            <a href="{{ route('super_admin.gyms.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Ajouter une salle
            </a>
        </div>

        <!-- Gyms List Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom de la Salle</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">État</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Expiration</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stats</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($gyms as $gym)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($gym->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $gym->name }}</div>
                                        <div class="text-xs text-gray-500">ID: #{{ $gym->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($gym->is_active && !$gym->isSubscriptionExpired())
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Expiré
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">
                                    {{ $gym->subscription_expires_at ? $gym->subscription_expires_at->format('d M, Y') : 'N/A' }}
                                </div>
                                @if($gym->subscription_expires_at && $gym->subscription_expires_at->diffInDays(now()) <= 7)
                                    <div class="text-xs text-red-500 font-semibold mt-1">
                                        Expire bientôt
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs text-gray-500">Membres: <span class="font-bold text-gray-700">{{ $gym->members_count }}</span></span>
                                    <span class="text-xs text-gray-500">Abos: <span class="font-bold text-gray-700">{{ $gym->subscriptions_count }}</span></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('super_admin.gyms.show', $gym) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <a href="{{ route('super_admin.gyms.edit', $gym) }}" class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-100">
                {{ $gyms->links() }}
            </div>
        </div>
    </div>
</x-super-admin-layout>
