<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    
                    <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-emerald-500">
                                <div class="bg-emerald-100 dark:bg-emerald-900 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Personal Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Full Name -->
                                <div class="md:col-span-2">
                                    <label for="full_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input id="full_name" 
                                           type="text" 
                                           name="full_name" 
                                           value="{{ old('full_name', $member->full_name) }}" 
                                           required 
                                           autofocus
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                    @error('full_name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CIN -->
                                <div>
                                    <label for="cin" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        National ID (CIN) <span class="text-red-500">*</span>
                                    </label>
                                    <input id="cin" 
                                           type="text" 
                                           name="cin" 
                                           value="{{ old('cin', $member->cin) }}" 
                                           required
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                    @error('cin')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Phone Number
                                    </label>
                                    <input id="phone" 
                                           type="text" 
                                           name="phone" 
                                           value="{{ old('phone', $member->phone) }}"
                                           placeholder="+212 6XX XXX XXX"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label for="gender" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Gender <span class="text-red-500">*</span>
                                    </label>
                                    <select id="gender" 
                                            name="gender" 
                                            required
                                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                        <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Update Photo (Optional)
                                    </label>
                                    @if($member->photo_path)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/' . $member->photo_path) }}" class="w-20 h-20 rounded-full object-cover border-2 border-emerald-500" alt="Current photo">
                                        </div>
                                    @endif
                                    <input id="photo" 
                                           type="file" 
                                           name="photo" 
                                           accept="image/*"
                                           class="w-full text-sm text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-900 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                    @error('photo')
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
                                    class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-md transition duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Member
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
