@props(['product' => $product])

<div class="flex flex-col justify-between bg-white border-2 border-gray-200 shadow-md p-2 hover:scale-105 min-w-[110px]">
    <div class="max-h-[180px] self-center">
        <img class="block mx-auto object-scale-down w-[180px] h-auto" src="{{ $product->thumbnail_image }}"/>
    </div>
    <div class="shrink self-stretch min-h-[90px]">
        <div class="max-h-[72px] mt-2 text-left">
            <span class="font-semibold line-clamp-2">{{ $product->name }}</span>
        </div>
        <x-star-rating class="text-left text-base" :stars="round($product->average_ratings)"/>
    </div>
    <div class="flex justify-between items-center">
        <span class="block mt-1 text-left text-lg">
            ${{ number_format($product->price) }}
        </span>
        <span class="block mt-1 text-left text-xs">
            {{ __('Sold') }} {{ $product->sold_quantity }}
        </span>
    </div>
</div>
