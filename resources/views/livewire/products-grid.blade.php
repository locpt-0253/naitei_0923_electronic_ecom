<div class="overflow-hidden mt-5">
    <div class="grid grid-cols-5 gap-3 mb-5">
        @foreach($products as $product)
        <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="block">
            <x-product-card :product="$product"/>
        </a>
        @endforeach
    </div>
</div>