@props(['product' => $product])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-3">
    <div class="px-6 py-4 bg-white border-b border-gray-200">
        <div class="flex items-center text-base mb-3 w-full h-full">
            <div class="w-[45%] ml-5">
                <a href="{{ route('products.show', ['productId' => $product->id]) }}" class="flex h-[80px] items-center justify-stretch">
                    <img src="{{ $product->thumbnail_image }}" class="max-w-full max-h-full object-scale-down">
                    <div class="text-base p-4 line-clamp-3">{{ $product->name }}</div>
                </a>
            </div>
            <div class="w-[15%] text-center">
                {{ number_format($product->price) }}
            </div>
            <div class="w-[15%] flex items-center flex-col justify-center">
                <form action="{{ route('cart.update', ['cart' => $product->pivot->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-stretch">
                        <button name="decrement" value="1" class="outline-none px-2 border border-gray-200 cursor-pointer text-sm flex items-center justify-center">
                            <i class="fi fi-sr-minus"></i>
                        </button>
                        <input type="text" name="quantity" value="{{ $product->pivot->quantity }}" role="spinbutton"
                            class="w-[50px] h-[32px] outline-none font-normal cursor-text border-gray-200 text-center"/>
                        <button name="increment" value="1" class="outline-none px-2 border border-gray-200 cursor-pointer text-sm flex items-center justify-center">
                            <i class="fi fi-sr-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-[15%] text-center">
                {{ number_format($product->pivot->quantity * $product->price) }}
            </div>
            <div class="w-[10%] text-center">
                <form action="{{ route('cart.destroy', ['cart' => $product->pivot->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>
                        <i class="fi fi-rs-trash text-base"></i>
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</div>
