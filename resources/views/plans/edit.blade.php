<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('تعديل خطة الاشتراك') }}: {{ $plan->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('plans.update', $plan) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">اسم الخطة</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $plan->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Duration -->
                            <div class="mb-4">
                                <label for="duration_days" class="block text-sm font-medium text-gray-700">المدة (بالأيام)</label>
                                <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days', $plan->duration_days) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">السعر (درهم)</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $plan->price) }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="is_active" class="block text-sm font-medium text-gray-700">الحالة</label>
                            <select name="is_active" id="is_active" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="1" {{ $plan->is_active ? 'selected' : '' }}>نشط</option>
                                <option value="0" {{ !$plan->is_active ? 'selected' : '' }}>غير نشط</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('training-types.show', $plan->training_type_id) }}" class="text-gray-600 hover:text-gray-900 ml-4">إلغاء</a>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                حفظ التعديلات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>