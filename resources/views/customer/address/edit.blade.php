<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Addresses') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl text-semibold">{{ __('Update address') }}</h1>
                    <div class="max-w-md mx-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('customer.address.update', ['address' => $address]) }}">
                        @csrf
                        @method('PUT')
                            <!-- Name -->
                            <div class="mt-4">
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full"
                                    :value="$address->name"
                                    type="text"
                                    name="name"
                                    required autofocus />
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="mt-4">
                                <x-label for="phone" :value="__('Phone Number')" />
                                <x-input id="phone" class="block mt-1 w-full"
                                    :value="$address->phone"
                                    type="text"
                                    name="phone"
                                    required autofocus />
                            </div>

                            <!-- Address -->
                            <div class="mt-4">
                                <x-label for="address" :value="__('Specific Address')" />
                                <x-input id="address" class="block mt-1 w-full"
                                    :value="$address->address"
                                    type="text"
                                    name="address"
                                    required autofocus />
                            </div>
                            
                            <div class="mt-4 flex items-center justify-center">
                                <x-button class="mx-auto">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
