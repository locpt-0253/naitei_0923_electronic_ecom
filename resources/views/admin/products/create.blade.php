<x-app-layout>
    @include('components.admin-header');

    <div class="pt-36">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 pb-0 bg-white border-b border-gray-200">
                    <div class="wrapper">
                        @include('components.message')
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}"
                            class="pb-10">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-input" name="name" required
                                    autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <input id="description" type="text" class="form-input" name="description" required
                                    autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="form-label">{{ __('Price') }}</label>
                                <input id="price" type="number" class="form-input" name="price" required
                                    autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="sold_quantity" class="form-label">{{ __('Sold quantity') }}</label>
                                <input id="sold_quantity" type="number" class="form-input" name="sold_quantity"
                                    required autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="stock_quantity" class="form-label">{{ __('Stock quantity') }}</label>
                                <input id="stock_quantity" type="number" class="form-input" name="stock_quantity"
                                    required autofocus>
                            </div>

                            <div class="mb-4">
                                <label for="category_id" class="form-label">{{ __('Category') }}</label>
                                <select id="category_id" name="category_id" class="form-input" required>
                                    <option value="">-- Select category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ ucfirst($category->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select id="status" name="status" class="form-input" required>
                                    <option value="">-- Select status --</option>
                                    @foreach (config('app.product_status') as $key => $value)
                                        <option value="{{ $value }}">
                                            {{ ucfirst($key) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="images" class="form-label">{{ __('Image') }}</label>

                                <input id="images" name="images[]" type="file" multiple accept="image/*" />

                                <div id="imageBody" class="table mt-2">
                                    <div class="row header green">
                                        <div class="cell">{{ __('Image') }}</div>
                                        <div class="cell">{{ __('Status') }}</div>
                                        <div class="cell">{{ __('Delete') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <x-button type="submit"
                                    class="inline-block px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none">
                                    {{ __('Create') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/image-upload.js') }}"></script>
</x-app-layout>
