<x-app-layout>
    @include('components.admin-header');

    <div class="pt-36">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 pb-0 bg-white border-b border-gray-200">
                    <div class="wrapper">
                        @include('components.message')
                        <x-button class="bg-green-500 float-right mb-2"
                            onclick="window.location.href='{{ route('admin.products.create') }}'">
                            {{ __('Create :resource', ['resource' => __('Product')]) }}
                        </x-button>
                        <div class="table">
                            <div class="row header green">
                                <div class="cell">ID</div>
                                <div class="cell">{{ __('Image') }}</div>
                                <div class="cell">{{ __('Name') }}</div>
                                <div class="cell">{{ __('Price') }}</div>
                                <div class="cell">{{ __('Sold') }}</div>
                                <div class="cell">{{ __('Stock') }}</div>
                                <div class="cell">{{ __('Status') }}</div>
                                <div class="cell">{{ __('Categoty') }}</div>
                                <div class="cell">{{ __('Created At') }}</div>
                                <div class="cell">{{ __('Action') }}</div>
                            </div>

                            @foreach ($products as $index => $product)
                                <div class="row">
                                    <div class="cell">{{ $product->id }}</div>
                                    <div class="cell">
                                        <img class="max-w-[35px] max-h-max-w-[35px]"
                                            src="{{ isset($product->images[0]) ? $product->images[0]->image_url : config('app.default_image.product') }}"
                                            alt="Product Image">
                                    </div>
                                    <div class="cell">{{ $product->name }}</div>
                                    <div class="cell">{{ $product->price }}</div>
                                    <div class="cell">{{ $product->sold_quantity }}</div>
                                    <div class="cell">{{ $product->stock_quantity }}</div>
                                    <div class="cell">
                                        {{ array_search($product->status, config('app.product_status')) }}</div>
                                    <div class="cell">{{ $product['category']['name'] }}</div>
                                    <div class="cell">{{ $product->created_at }}</div>
                                    <div class="cell flex gap-2">
                                        <x-button class="bg-purple-600"
                                            onclick="window.location.href='{{ route('admin.products.edit', ['product' => $product->id]) }}'">
                                            {{ __('Edit') }}
                                        </x-button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST" onsubmit="return confirm('{{ __('Delete Confirm') }}')">
                                            @csrf
                                            @method('DELETE')

                                            <x-button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                                {{ __('Delete') }}</x-button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
