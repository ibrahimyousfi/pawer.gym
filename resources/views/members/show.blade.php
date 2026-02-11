<x-app-layout>
    @if(request()->has('print'))
    <style>
        @media print {
            nav, header, footer, .no-print { display: none !important; }
            .py-8 { padding: 0 !important; }
            .max-w-5xl { max-width: 100% !important; width: 100% !important; margin: 0 !important; padding: 0 !important; }
            .shadow-sm { box-shadow: none !important; border: 1px solid #e5e7eb !important; }
            body { background: white !important; }
            .bg-gray-50 { background: white !important; }
        }
    </style>
    <script>
        window.onload = function() { window.print(); }
    </script>
    @endif

    <div class="py-8 ">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Member Profile Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Photo -->
                        <div class="flex-shrink-0">
                            @if($member->photo_path)
                                <img src="{{ asset('uploads/' . $member->photo_path) }}" 
                                     class="w-32 h-32 rounded-full object-cover border-4 border-emerald-500" 
                                     alt="{{ $member->full_name }}">
                            @else
                                <div class="w-32 h-32 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center border-4 border-emerald-500">
                                    <span class="text-emerald-700 dark:text-emerald-300 font-bold text-4xl">
                                        {{ substr($member->full_name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $member->full_name }}</h3>
                            
                            @php $status = $member->status; @endphp
                            <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full 
                                {{ $status == 'Active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                {{ $status == 'Expired' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}
                                {{ $status == 'Inactive' ? 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                            ">
                                {{ $status }}
                            </span>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">CIN</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $member->cin }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $member->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Gender</p>
                                    <p class="font-semibold text-gray-900 dark:text-white capitalize">{{ $member->gender }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Joined</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $member->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-3 no-print">
                        @if($member->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            WhatsApp
                        </a>
                        @endif
                        <a href="{{ route('members.edit', $member) }}" 
                           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            Edit Member
                        </a>
                        <a href="{{ route('members.renew', $member) }}" 
                           class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            Renew Subscription
                        </a>
                        <button onclick="window.print()" 
                                class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                            Print Member Card
                        </button>
                    </div>
                </div>
            </div>

            <!-- Subscription History -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg no-print">
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Subscription History</h3>
                    
                    @if($member->subscriptions->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b-2 border-gray-200 dark:border-gray-700">
                                <tr class="text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <th class="pb-3">Plan</th>
                                    <th class="pb-3">Training Type</th>
                                    <th class="pb-3">Duration</th>
                                    <th class="pb-3">Start Date</th>
                                    <th class="pb-3">End Date</th>
                                    <th class="pb-3">Price</th>
                                    <th class="pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($member->subscriptions->sortByDesc('created_at') as $subscription)
                                <tr>
                                    <td class="py-3 font-medium text-gray-900 dark:text-white">{{ $subscription->plan->name }}</td>
                                    <td class="py-3 text-sm text-gray-600 dark:text-gray-400">{{ $subscription->plan->trainingType->name }}</td>
                                    <td class="py-3 text-sm text-gray-600 dark:text-gray-400">{{ $subscription->plan->duration_days }} days</td>
                                    <td class="py-3 text-sm text-gray-600 dark:text-gray-400">{{ $subscription->start_date->format('Y-m-d') }}</td>
                                    <td class="py-3 text-sm text-gray-600 dark:text-gray-400">{{ $subscription->end_date->format('Y-m-d') }}</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($subscription->price_snapshot, 2) }} MAD</td>
                                    <td class="py-3">
                                        @if($subscription->end_date >= now()->toDateString())
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-800">Expired</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No subscription history available.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
