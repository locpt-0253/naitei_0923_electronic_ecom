<x-app-layout>
    @include('components.admin-header');

    <div class="pt-36">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 pb-0 bg-white border-b border-gray-200">
                    <div class="wrapper">
                        @include('components.message')
                        <div class="table">
                            <div class="row header green">
                                <div class="cell">ID</div>
                                <div class="cell">{{ __('Address') }}</div>
                                <div class="cell">{{ __('Products') }}</div>
                                <div class="cell">{{ __('Status') }}</div>
                                <div class="cell">{{ __('Create At') }}</div>
                            </div>

                            @foreach ($orders as $index => $order)
                            <div class="row">
                                <div class="cell">{{ $order->id }}</div>
                                <div class="cell ">
                                    <div class="w-68">
                                        <div class="font-bold">{{ $order->address->name }} {{ $order->address->phone }}</div>
                                        <div>{{ $order->address->address }}</div>
                                    </div>
                                </div>
                                <div class="cell flex flex-col gap-1">
                                    @foreach ($order->products as $product)
                                        <div class="grid grid-cols-4 gap-2 w-72">
                                            <div class="col-span-2">{{ $product->name }}</div>
                                            <div class="col-span-1 inline-block bg-green-200 text-slate-800 py-1 px-2 rounded-full text-sm font-semibold shadow-md">
                                                {{ $product->price }}
                                            </div>
                                            <div class="col-span-1 w-fit inline-block bg-purple-200 text-slate-800 py-1 px-2 rounded-full text-sm font-semibold shadow-md">&times{{ $product->pivot->quantity }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cell">
                                    <form id="{{ 'changeStatusForm' . $order->id }}" method="POST" action="{{ route('admin.orders.change-status', $order->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select
                                            onchange="document.getElementById('{{ 'changeStatusForm' . $order->id }}').submit()"
                                            name="status"
                                            class="block appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        >
                                            @foreach (config('app.order_status') as $status_name => $value)
                                                <option value="{{ $value }}" class="inline-block bg-blue-200 text-blue-800 py-1 px-2 rounded-full text-xs font-semibold {{ config('app.order_status_color')[$value] }}" {{ $order->status == $value ? 'selected' : '' }}>
                                                    {{ $status_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                <div class="cell">{{ $order->created_at }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
