<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[80px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.message')
            <div class="container mt-8 flex justify-between items-start space-x-5">
                <div class="w-full">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                        <div class="px-6 py-3 bg-white border-b border-gray-200 h-[55px]">
                            <div class="flex items-center text-base w-full h-full">
                                <div class="w-[45%] ml-5 text-center font-semibold">
                                    {{ __('Product') }}
                                </div>
                                <div class="w-[15%] text-center font-semibold">
                                    {{ __('Unit price') }}
                                </div>
                                <div class="w-[15%] text-center font-semibold">
                                    {{ __('Quantity') }}
                                </div>
                                <div class="w-[15%] text-center font-semibold">
                                    {{ __('Amount') }}
                                </div>
                                <div class="w-[10%] text-center font-semibold">
                                    {{ __('Action') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($cartProducts as $product)
                        <x-cart-product :product="$product" />
                    @endforeach
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg min-w-[300px]">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h1 class="text-xl font-semibold mb-5 uppercase">
                                    {{ __('Address') }}
                                </h1>
                                <div class="mb-4">
                                    <select id="address_id" name="address_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 required">
                                        <option value="">-- {{ __('Select Address') }} --</option>
                                        @foreach($addresses as $address)
                                            <option value='{{ $address->id }}'>
                                                <div class="flex gap-5">
                                                    <div class="font-bold">{{ $address->name }} {{ $address->phone }}</div>
                                                    <div>{{ $address->address }}</div>
                                                </div>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm rounded-lg min-w-[300px]">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h1 class="text-xl font-semibold mb-5 uppercase">
                                    {{ __('Payment Method') }}
                                </h1>
                                <div class="mb-4">
                                    <select id="payment_method" name="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 required">
                                        <option value="">-- {{ __('Select Method') }} --</option>
                                        @foreach(config('app.payment_methods') as $method)
                                            <option value='{{ $method }}'>
                                                {{ $method }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow-sm rounded-lg min-w-[300px]">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h1 class="text-xl font-semibold mb-5 uppercase">
                                    {{ __('Order summary') }}
                                </h1>
                                <div class="flex flex-nowrap justify-between items-center">
                                    <span class="font-normal text-gray-500">{{ __('Total amount') }}</span>
                                    <div class="text-red-500 text-2xl">${{ number_format($totalAmount) }}</div>
                                </div>
                                <x-button type="submit" class="!bg-blue-500 w-full mt-5">
                                    <span class="block w-full text-center">
                                        {{ __('Place order') }}
                                    </span>
                                </x-button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
