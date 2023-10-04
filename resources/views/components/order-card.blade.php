@props([
    'order' => $order,
])

<div class="p-6 my-4 bg-white rounded-lg overflow-hidden shadow-sm border-b border-gray-100">
    <div class="flex justify-between items-center border-b border-gray-200">
        <div class="text-center py-2">
            <span class="text-base font-bold uppercase">{{ __('Order id') }}:</span>
            <span class="text-base">{{ $order->id }}</span>
        </div>
        @switch ($order->status)
            @case (config('app.order_status')['processing'])
                <div class="text-center text-lg font-semibold uppercase bg-yellow-100 px-3 py-1 rounded-lg mb-2 text-yellow-600">{{ __('Processing') }}</div>
                @break

            @case (config('app.order_status')['in_transit'])
                <div class="text-center text-lg font-semibold uppercase bg-blue-100 px-3 py-1 rounded-lg mb-2 text-blue-500">{{ __('Transporting') }}</div>
                @break

            @case (config('app.order_status')['completed'])
                <div class="text-center text-lg font-semibold uppercase bg-green-100 px-3 py-1 rounded-lg mb-2 text-green-500">{{ __('Completed') }}</div>
                @break
            
            @case (config('app.order_status')['canceled'])
                <div class="text-center text-lg font-semibold uppercase bg-red-100 px-3 py-1 rounded-lg mb-2 text-red-500">{{ __('Cancelled') }}</div>
                @break

            @default
                
        @endswitch
    </div>
    <div class="flex flex-col justify-center items-center border-b border-gray-200 py-2">
        @foreach ($order->products as $product)
            <div class="my-1 flex items-center justify-between w-full">
                <div class="flex items-center justify-start mr-3">
                    <a class="block w-[82px] aspect-square mx-3" href="{{ route('products.show', ['productId' => $product->id]) }}">
                        <img src="{{ $product->thumbnail_image }}" class="max-w-full h-auto">
                    </a>
                    <div class="">
                        <span class="block font-semibold text-lg">{{ $product->name }}</span>
                        <span>x{{ $product->pivot->quantity }}</span>
                    </div>
                </div>
                <div class="w-32">
                    <span class="text-red-500">${{ number_format($product->price * $product->pivot->quantity) }}</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex items-center justify-between pt-6 px-6 pb-3">
        <div>
            <div>{{ $order->order_date }}</div>
            <div>{{ $order->address->name }}</div>
            <div>{{ $order->address->phone }}</div>
            <div>{{ $order->address->address }}</div>
        </div>
        <div class="flex items-center">
            <label class="mr-2.5">{{ __('Total amount') }}:</label>
            <div class="font-semibold text-2xl">${{ number_format($order->bill->total) }}</div>
        </div>
    </div>
    @if ($order->status == config('app.order_status')['processing'])
        <form action="{{ route('customer.orders.update', ['order' => $order]) }}" method="POST">
        @csrf
        @method('PUT')
            <div class="flex items-center justify-end space-x-3">
                <x-button class="!bg-red-600">
                    {{ __('Cancel') }}
                </x-button>
            </div>
        </form>
    @endif
</div>
