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
                        @foreach ($allCategories as $category)
                            <a href="{{ route('products.index', ['categoryId' => $category->id]) }}" 
                                class="flex flex-col items-center hover:bg-slate-100 border-2 border-gray-100 shadow-md p-2">
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

            <div class="container mt-8 flex">
                <div id="products-filter-panel" class="mr-5 flex flex-col min-w-[180px] items-stretch">
                    <div id="filter-title">
                        <i class="fi fi-br-bars-filter"></i>
                        <span class="uppercase font-semibold text-md ml-2">{{ __('Filter') }}</span>
                    </div>
                    <div class="py-5 border-b-gray-500 border-b-2">
                        <div class="font-medium text-md mb-3">{{ __('Ratings') }}</div>
                        <div class="flex flex-col items-start">
                            <a href="{{ route('products.search', array_merge(request()->all(), ['ratingFilter' => 5])) }}"
                                class="cursor-pointer @if(request('ratingFilter') == 5) bg-gray-200 rounded-full @endif flex items-center px-3 space-x-2">
                                <x-star-rating class="text-center" :stars="5"/>
                            </a>
                            <a href="{{ route('products.search', array_merge(request()->all(), ['ratingFilter' => 4])) }}"
                                class="cursor-pointer @if(request('ratingFilter') == 4) bg-gray-200 rounded-full @endif flex items-center px-3 space-x-2">
                                <x-star-rating class="text-center" :stars="4"/>
                                <span class="text-black">trở lên</span>
                            </a>
                            <a href="{{ route('products.search', array_merge(request()->all(), ['ratingFilter' => 3])) }}"
                                class="cursor-pointer @if(request('ratingFilter') == 3) bg-gray-200 rounded-full @endif flex items-center px-3 space-x-2">
                                <x-star-rating class="text-center" :stars="3"/>
                                <span class="text-black">trở lên</span>
                            </a>
                            <a href="{{ route('products.search', array_merge(request()->all(), ['ratingFilter' => 2])) }}"
                                class="cursor-pointer @if(request('ratingFilter') == 2) bg-gray-200 rounded-full @endif flex items-center px-3 space-x-2">
                                <x-star-rating class="text-center" :stars="2"/>
                                <span class="text-black">trở lên</span>
                            </a>
                            <a href="{{ route('products.search', array_merge(request()->all(), ['ratingFilter' => 1])) }}"
                                class="cursor-pointer @if(request('ratingFilter') == 1) bg-gray-200 rounded-full @endif flex items-center px-3 space-x-2">
                                <x-star-rating class="text-center" :stars="1"/>
                                <span class="text-black">trở lên</span>
                            </a>
                        </div>
                    </div>
                    <div class="py-5 border-b-gray-500 border-b-2">
                        <div class="font-medium text-md mb-3">{{ __('Price Range') }}</div>
                        <form action="{{ route('products.search', array_merge(request()->all())) }}" method="GET">
                            <div class="flex flex-col items-stretch space-y-3">
                                <div class="flex items-center justify-between">
                                    <x-input type="text" name="minPrice" class="max-w-[80px] text-center px-2 outline-none" 
                                        placeholder="{{ __('From') }}" :value="request('minPrice')" />
                                    <x-input type="text" name="maxPrice" class="max-w-[80px] text-center px-2 outline-none" 
                                        placeholder="{{ __('To') }}" :value="request('maxPrice')" />
                                    <x-input type="hidden" name="keyword" :value="request('keyword')"/>
                                    <x-input type="hidden" name="sortBy" :value="request('sortBy')"/>
                                    <x-input type="hidden" name="categoryId" :value="request('categoryId')"/>
                                    <x-input type="hidden" name="ratingFilter" :value="request('ratingFilter')"/>
                                </div>
                                <x-button class="uppercase py-2 px-4 text-center">
                                    {{ __('Apply') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                    <div class="py-5">
                        <a href="{{ route('products.search', array_merge(request()->except(['ratingFilter', 'minPrice', 'maxPrice']))) }}"
                            class="bg-gray-800 px-4 py-2 uppercase text-white font-semibold rounded-md text-sm">
                            {{ __('Delete all') }}
                        </a>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    @if (request('keyword'))
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h1 class="text-2xl font-medium mb-5 uppercase">{{ __('Search results for') }} "{{ request()->keyword }}"</h1>
                                <p class="mt-2 text-md max-w-[600px]">{{ __('Found :result results', ['result' => $products->count()]) }}</p>
                            </div>
                        </div>
                    @endif
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
                    <div class="overflow-hidden mt-5">
                        <div class="grid grid-cols-5 gap-3 mb-5">
                            @foreach($products as $product)
                            <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="block">
                                <x-product-card :product="$product"/>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
