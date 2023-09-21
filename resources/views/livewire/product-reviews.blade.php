<div class="bg-white overflow-hidden shadow-md sm:rounded-lg mt-6">
    <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-semibold mb-5 uppercase">{{ __('Product Reviews') }}</h1>
        <div class="p-6 bg-gray-100 border border-gray-300 min-h-[5rem] mb-4 box-border flex items-center">
            <div class="text-center mr-8">
                <div class="text-lg">
                    <span class="text-2xl font-semibold">{{ $product->average_ratings }}</span>
                    <span>{{ __('out of 5') }}</span>
                </div>
                <div class="text-2xl">
                    <x-star-rating class="" :stars="round($product->average_ratings)"/>
                </div>
            </div>
            <div class="ml-4 flex justify-start items-center flex-1 space-x-2">
                <button wire:click="all"
                    class="py-2 px-3 shadow-sm border @if($currentFilter == 'all') border-red-500 @else border-slate-300 @endif">
                    {{ __('All') }}
                </button>
                @for ($i = config('constants.max_ratings'); $i > 0; $i--)
                <button wire:click="filterOnStar({{ $i }})"
                    class="py-2 px-3 shadow-sm border @if($currentFilter == $i . 'star') border-red-500 @else border-slate-300 @endif">
                    {{ __(':star stars', ['star' => $i]) }}
                </button>
                @endfor
            </div>
        </div>
        @foreach($shownReviews as $review)
            <x-product-review :review="$review"/>
        @endforeach
    </div>
</div>
