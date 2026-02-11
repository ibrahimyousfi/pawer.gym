<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-zinc-900 border border-zinc-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-8">

                    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Personal Information Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-3 border-b border-orange-500/30">
                                <div class="bg-orange-500/10 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white uppercase tracking-wide">Informations Personnelles</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Full Name -->
                                <div class="md:col-span-2">
                                    <label for="full_name" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Nom Complet <span class="text-orange-500">*</span>
                                    </label>
                                    <input id="full_name"
                                           type="text"
                                           name="full_name"
                                           value="{{ old('full_name') }}"
                                           required
                                           autofocus
                                           class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                    @error('full_name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CIN -->
                                <div>
                                    <label for="cin" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        CIN <span class="text-orange-500">*</span>
                                    </label>
                                    <input id="cin"
                                           type="text"
                                           name="cin"
                                           value="{{ old('cin') }}"
                                           required
                                           class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                    @error('cin')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Numéro de Téléphone
                                    </label>
                                    <input id="phone"
                                           type="text"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="+212 6XX XXX XXX"
                                           class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Sexe <span class="text-orange-500">*</span>
                                    </label>
                                    <select id="gender"
                                            name="gender"
                                            required
                                            class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Photo (Optionnel)
                                    </label>
                                    <input id="photo"
                                           type="file"
                                           name="photo"
                                           accept="image/*"
                                           class="w-full text-sm text-zinc-300 border border-zinc-800 rounded-lg cursor-pointer bg-zinc-950 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-bold file:bg-zinc-800 file:text-orange-500 hover:file:bg-zinc-700">
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-3 border-b border-orange-500/30">
                                <div class="bg-orange-500/10 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white uppercase tracking-wide">Abonnement Initial</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Plan -->
                                <div>
                                    <label for="plan_id" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Sélectionner un Plan <span class="text-orange-500">*</span>
                                    </label>
                                    <select id="plan_id"
                                            name="plan_id"
                                            required
                                            class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                        <option value="">-- Choisir un Plan --</option>
                                        @foreach($trainingTypes as $type)
                                            <optgroup label="{{ $type->name }}" class="font-bold text-orange-500">
                                                @foreach($type->plans as $plan)
                                                    @php
                                                        $isSelected = old('plan_id') == $plan->id ||
                                                                    ($preselectedPlanId == $plan->id) ||
                                                                    (isset($preselectedTrainingTypeId) && $preselectedTrainingTypeId == $type->id && $type->plans->first()->id == $plan->id && !old('plan_id') && !$preselectedPlanId);
                                                    @endphp
                                                    <option value="{{ $plan->id }}" {{ $isSelected ? 'selected' : '' }} class="text-white">
                                                        {{ $plan->name }} - {{ $plan->duration_days }} jours ({{ $plan->price }} MAD)
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('plan_id')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div>
                                    <label for="start_date" class="block text-sm font-bold text-zinc-400 mb-2 uppercase tracking-wider">
                                        Date de Début <span class="text-orange-500">*</span>
                                    </label>
                                    <input id="start_date"
                                           type="date"
                                           name="start_date"
                                           value="{{ old('start_date', date('Y-m-d')) }}"
                                           required
                                           class="w-full rounded-lg border-zinc-800 bg-zinc-950 text-white focus:border-orange-500 focus:ring-orange-500 shadow-sm">
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-zinc-800">
                            <a href="{{ route('members.index') }}"
                               class="inline-flex justify-center items-center px-6 py-3 bg-zinc-800 text-zinc-300 font-bold uppercase tracking-wider rounded-lg hover:bg-zinc-700 hover:text-white transition duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex justify-center items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold uppercase tracking-wider rounded-lg shadow-lg shadow-orange-900/20 transition duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Créer et Abonner
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
