<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $trainingType->name }}
            </h2>
            <a href="{{ route('plans.create', ['training_type_id' => $trainingType->id]) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                + إضافة خطة تسعير
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">الوصف</h3>
                    <p class="text-gray-600">{{ $trainingType->description ?? 'لا يوجد وصف' }}</p>
                    
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('training-types.edit', $trainingType) }}" class="text-indigo-600 hover:text-indigo-900">تعديل البيانات</a>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold mb-4 px-2">خطط الأسعار المتاحة</h3>
            
            @if($trainingType->plans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($trainingType->plans as $plan)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border {{ $plan->is_active ? 'border-green-200' : 'border-red-200' }}">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="text-lg font-bold">{{ $plan->name }}</h4>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $plan->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </div>
                                <div class="text-3xl font-bold text-gray-900 mb-1">
                                    {{ $plan->price }} <span class="text-sm font-normal text-gray-500">درهم</span>
                                </div>
                                <p class="text-gray-500 mb-4">المدة: {{ $plan->duration_days }} يوم</p>

                                <div class="flex justify-end space-x-2 border-t pt-4">
                                    <a href="{{ route('plans.edit', $plan) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">تعديل</a>
                                    <form action="{{ route('plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخطة؟');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-500 mb-4">لا توجد خطط أسعار مضافة لهذا النوع.</p>
                    <a href="{{ route('plans.create', ['training_type_id' => $trainingType->id]) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">أضف أول خطة</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>