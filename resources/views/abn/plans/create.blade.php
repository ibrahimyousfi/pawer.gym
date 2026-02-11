<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('plans.store') }}">
                        @csrf

                        <!-- Training Type -->
                        <div class="mb-4">
                            <label for="training_type_id" class="block text-sm font-medium text-gray-700">نوع الاشتراك</label>
                            <select name="training_type_id" id="training_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach($trainingTypes as $type)
                                    <option value="{{ $type->id }}" {{ (old('training_type_id') == $type->id || (isset($selectedTrainingTypeId) && $selectedTrainingTypeId == $type->id)) ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('training_type_id')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">اسم الخطة (مثال: اشتراك شهري، سنوي)</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Duration -->
                            <div class="mb-4">
                                <label for="duration_days" class="block text-sm font-medium text-gray-700">المدة (بالأيام)</label>
                                <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days', 30) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <p class="text-xs text-gray-500 mt-1">30 = شهر، 365 = سنة</p>
                                <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">السعر (درهم)</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900 ml-4">إلغاء</a>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                حفظ الخطة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>