<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <nav class="bg-white border-b border-gray-100 mx-auto px-4">
                    <div class="flex justify-around h-16">
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('customer.orders.index')" :active="!request('status')">
                                {{ __('All') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('customer.orders.index', ['status' => 'processing'])" :active="request('status') == 'processing'">
                                {{ __('Processing') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('customer.orders.index', ['status' => 'in_transit'])" :active="request('status') == 'in_transit'">
                                {{ __('Transporting') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('customer.orders.index', ['status' => 'completed'])" :active="request('status') == 'completed'">
                                {{ __('Completed') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('customer.orders.index', ['status' => 'canceled'])" :active="request('status') == 'canceled'">
                                {{ __('Cancelled') }}
                            </x-nav-link>
                        </div>
                    </div>
                </nav>
            </div>
            @foreach ($orders as $order)
                <x-order-card :order="$order"/>
            @endforeach

            {{ $orders->appends(request()->input())->links() }}

        </div>
    </div>
</x-app-layout>
