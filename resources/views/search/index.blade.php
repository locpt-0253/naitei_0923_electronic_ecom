<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class="text-2xl font-semibold mb-5">{{ __('Categories') }}</h1>
                    <div class="grid grid-cols-11 gap-1">
                        
                        @foreach($allCategories as $category)
                        <a href="{{ route('products.index', ['categoryId' => $category->id]) }}" class="flex flex-col items-center hover:bg-slate-100 border-2 border-gray-100 shadow-md p-2">
                            <div class="shrink max-h-[80px] py-2">
                                <img class="max-w-full max-h-full align-middle" src="/storage/default_product.png" />
                            </div>
                            <span class="block mt-2 text-center font-semibold">{{ $category->name }}</span>
                            <span class="block mt-1 text-center text-sm">{{ $category->products->count() }} {{ __('products') }}</span>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-medium mb-5 uppercase">{{ __('Search results for') }} "{{ request()->keyword }}"</h1>
                    <p class="mt-2 text-md max-w-[600px]">{{ __('Found :result results', ['result' => $products->count()]) }}</p>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200 flex items-center space-x-2">
                    <h2 class="text-lg font-semibold">{{ __('Sort by') }}</h2>
                    <div class="flex justify-start items-stretch flex-1 space-x-2">
                        <a href="{{ route('products.search', array_merge(request()->except('sort'), ['sortBy' => 'name'])) }}" 
                            class="py-2 px-3 @if(request('sortBy') == 'name') bg-green-300 @else bg-white @endif shadow-sm border border-gray-200">
                            {{ __('Ratings') }}
                        </a>
                        <a href="{{ route('products.search', array_merge(request()->except('sort'), ['sortBy' => 'created_at'])) }}" 
                            class="py-2 px-3 @if(request('sortBy') == 'created_at') bg-green-300 @else bg-white @endif shadow-sm border border-gray-200">
                            {{ __('Latest') }}
                        </a>
                        <a href="{{ route('products.search', array_merge(request()->all(), ['sortBy' => 'price', 'sort' => 'asc'])) }}" 
                            class="py-2 px-3 @if(request('sortBy') == 'price' && request('sort') == 'asc') bg-green-300 @else bg-white @endif shadow-sm border border-gray-200">
                            {{ __('Ascending Prices') }}
                        </a>
                        <a href="{{ route('products.search', array_merge(request()->all(), ['sortBy' => 'price', 'sort' => 'desc'])) }}" 
                            class="py-2 px-3 @if(request('sortBy') == 'price' && request('sort') == 'desc') bg-green-300 @else bg-white @endif shadow-sm border border-gray-200">
                            {{ __('Descending Prices') }}
                        </a>
                    </div>
                </div>
            </div>
            @livewire('products-grid', ['products' => $products])
        </div>
    </div>
</x-app-layout>
