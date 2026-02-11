<x-app-layout>
    <!-- Members Table - Desktop -->
    <div class="hidden lg:block bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 lg:p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr class="text-left text-xs lg:text-sm font-semibold text-gray-700">
                            <th class="pb-3 pl-4">Member</th>
                            <th class="pb-3">Contact</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Current Subscription</th>
                            <th class="pb-3">Expires On</th>
                            <th class="pb-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($members as $member)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Member Info with Photo -->
                            <td class="py-4 pl-4">
                                <div class="flex items-center gap-3">
                                    @if($member->photo_path)
                                        <img src="{{ asset('uploads/' . $member->photo_path) }}" 
                                             class="w-10 h-10 lg:w-12 lg:h-12 rounded-lg object-cover border border-gray-200" 
                                             alt="{{ $member->full_name }}">
                                    @else
                                        <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-lg bg-gray-200 flex items-center justify-center border border-gray-300">
                                            <span class="text-gray-600 font-semibold text-base lg:text-lg">
                                                {{ substr($member->full_name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="font-medium text-sm lg:text-base text-gray-900 truncate">{{ $member->full_name }}</div>
                                        <div class="text-xs text-gray-500 font-mono truncate">CIN: {{ $member->cin }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="py-4">
                                <div class="text-xs lg:text-sm text-gray-900 font-mono">{{ $member->phone ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ $member->gender == 'male' ? 'Male' : 'Female' }}</div>
                            </td>

                            <!-- Status -->
                            <td class="py-4">
                                <x-status-badge :status="$member->status" />
                            </td>

                            <!-- Current Plan -->
                            <td class="py-4">
                                @php $activeSub = $member->subscriptions->where('end_date', '>=', now()->toDateString())->first(); @endphp
                                @if($activeSub)
                                    <div class="text-xs lg:text-sm font-medium text-gray-900">{{ $activeSub->plan->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $activeSub->plan->trainingType->name }}</div>
                                @else
                                    <span class="text-gray-400 text-xs lg:text-sm">No active plan</span>
                                @endif
                            </td>

                            <!-- Expiration -->
                            <td class="py-4">
                                @if($activeSub)
                                    @php 
                                        $daysLeft = now()->diffInDays($activeSub->end_date, false);
                                        $isExpiringSoon = $daysLeft <= 7 && $daysLeft >= 0;
                                    @endphp
                                    <div class="text-xs lg:text-sm font-mono {{ $isExpiringSoon ? 'text-orange-600 font-semibold' : 'text-gray-900' }}">
                                        {{ $activeSub->end_date->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs {{ $isExpiringSoon ? 'text-orange-600' : 'text-gray-500' }}">
                                        ({{ $daysLeft }} days left)
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs lg:text-sm">-</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4">
                                <div class="flex items-center justify-center gap-1 lg:gap-2">
                                    <!-- WhatsApp -->
                                    @if($member->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" 
                                       target="_blank"
                                       class="p-1.5 lg:p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                                       title="WhatsApp">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </a>
                                    @endif

                                    <!-- View -->
                                    <a href="{{ route('members.show', $member) }}" 
                                       class="p-1.5 lg:p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                       title="View Details">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('members.edit', $member) }}" 
                                       class="p-1.5 lg:p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                       title="Edit">
                                        <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">
                                No members found. Start by adding one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Members Cards - Mobile -->
    <div class="lg:hidden space-y-4">
        @forelse($members as $member)
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-start gap-3 mb-3">
                @if($member->photo_path)
                    <img src="{{ asset('uploads/' . $member->photo_path) }}" 
                         class="w-12 h-12 rounded-lg object-cover border border-gray-200 shrink-0" 
                         alt="{{ $member->full_name }}">
                @else
                    <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center border border-gray-300 shrink-0">
                        <span class="text-gray-600 font-semibold text-lg">
                            {{ substr($member->full_name, 0, 1) }}
                        </span>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-medium text-gray-900 truncate">{{ $member->full_name }}</div>
                    <div class="text-xs text-gray-500 font-mono truncate">CIN: {{ $member->cin }}</div>
                    <div class="mt-1">
                        <x-status-badge :status="$member->status" />
                    </div>
                </div>
            </div>
            
            <div class="space-y-2 text-sm mb-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Phone:</span>
                    <span class="text-gray-900 font-mono">{{ $member->phone ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Gender:</span>
                    <span class="text-gray-900 capitalize">{{ $member->gender == 'male' ? 'Male' : 'Female' }}</span>
                </div>
                @php $activeSub = $member->subscriptions->where('end_date', '>=', now()->toDateString())->first(); @endphp
                @if($activeSub)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Plan:</span>
                        <span class="text-gray-900">{{ $activeSub->plan->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Expires:</span>
                        @php 
                            $daysLeft = now()->diffInDays($activeSub->end_date, false);
                            $isExpiringSoon = $daysLeft <= 7 && $daysLeft >= 0;
                        @endphp
                        <span class="{{ $isExpiringSoon ? 'text-orange-600 font-semibold' : 'text-gray-900' }}">
                            {{ $activeSub->end_date->format('d/m/Y') }} ({{ $daysLeft }} days)
                        </span>
                    </div>
                @endif
            </div>
            
            <div class="flex items-center justify-end gap-2 pt-3 border-t border-gray-200">
                @if($member->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" 
                   target="_blank"
                   class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                   title="WhatsApp">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </a>
                @endif
                <a href="{{ route('members.show', $member) }}" 
                   class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                   title="View">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </a>
                <a href="{{ route('members.edit', $member) }}" 
                   class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                   title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8 text-center">
            <p class="text-gray-500">No members found. Start by adding one!</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 lg:mt-6">
        {{ $members->links() }}
    </div>
</x-app-layout>
