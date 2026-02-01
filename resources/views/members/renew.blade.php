<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Renew Subscription') }} - {{ $member->full_name }}
        </h2>
    </x-slot>

    <div class="py-8 ">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    
                    <div class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg border border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="font-bold text-emerald-800 dark:text-emerald-300">Current Status</h4>
                                <p class="text-sm text-emerald-700 dark:text-emerald-400">
                                    Member: <span class="font-semibold">{{ $member->full_name }}</span> | 
                                    Status: <span class="font-semibold text-{{ $member->status == 'Active' ? 'green' : 'red' }}-600">{{ $member->status }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('members.storeRenewal', $member) }}" class="space-y-8">
                        @csrf

                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-emerald-500">
                                <div class="bg-emerald-100 dark:bg-emerald-900 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Subscription Renewal</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Plan -->
                                <div>
                                    <label for="plan_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Select New Plan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="plan_id" 
                                            name="plan_id" 
                                            required
                                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                        <option value="">-- Choose a Plan --</option>
                                        @foreach($trainingTypes as $type)
                                            <optgroup label="{{ $type->name }}" class="font-semibold">
                                                @foreach($type->plans as $plan)
                                                    <option value="{{ $plan->id }}" {{ old('plan_id', $member->subscriptions->last()?->plan_id) == $plan->id ? 'selected' : '' }}>
                                                        {{ $plan->name }} - {{ $plan->duration_days }} days ({{ $plan->price }} MAD)
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('plan_id')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div>
                                    <label for="start_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Subscription Start Date <span class="text-red-500">*</span>
                                    </label>
                                    @php
                                        $lastSub = $member->subscriptions->sortByDesc('end_date')->first();
                                        $suggestedDate = $lastSub && $lastSub->end_date->isFuture() 
                                            ? $lastSub->end_date->addDay()->format('Y-m-d') 
                                            : date('Y-m-d');
                                    @endphp
                                    <input id="start_date" 
                                           type="date" 
                                           name="start_date" 
                                           value="{{ old('start_date', $suggestedDate) }}" 
                                           required
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                    <p class="mt-1 text-xs text-gray-500">Suggested to start right after previous subscription ends.</p>
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('members.index') }}" 
                               class="inline-flex justify-center items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex justify-center items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Confirm Renewal
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
