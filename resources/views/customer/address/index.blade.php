<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Addresses') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                    <h1 class="text-2xl text-semibold">{{ __('Addresses') }}</h1>
                    <a href="{{ route('customer.address.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent 
                            rounded-md font-semibold uppercase text-white text-xs hover:bg-gray-700 ">
                        <i class="fi fi-br-plus"></i>
                        <span class="text-center mx-2 block">{{ __('Add address') }}</span>
                    </a>
                </div>
            </div>
            <div class="mt-5 bg-white overflow-hidden shadow-md rounded-lg mx-auto">

                @if($addresses->count() == 0)
                <div class="px-4 py-5 border-b border-gray-200">
                    <p>{{ __('No address') }}</p>
                </div>
                @endif

                @foreach($addresses as $address)
                <div class="py-4 px-5 border-b border-b-gray-300 flex justify-between items-center">
                    <div class="min-w-[720px]">
                        <div class="py-1 flex items-center justify-between text-gray-700">
                            <div class="flex flex-nowrap justify-start space-x-4">
                                <i class="fi fi-rr-id-card-clip-alt"></i>
                                <div class="flex flex-col">
                                    {{ __('Name') }}
                                </div>
                            </div>
                            <span class="block">{{ $address->name }}</span>
                        </div>
                        <div class="py-1 flex items-center justify-between text-gray-700">
                            <div class="flex flex-nowrap justify-start space-x-4">
                                <i class="fi fi-rr-phone-flip"></i>
                                <div class="flex flex-col">
                                    {{ __('Phone Number') }}
                                </div>
                            </div>
                            <span class="block">{{ $address->phone }}</span>
                        </div>
                        <div class="py-1 flex items-center justify-between text-gray-700">
                            <div class="flex flex-nowrap justify-start space-x-4">
                                <i class="fi fi-rs-marker"></i>
                                <div class="flex flex-col">
                                    {{ __('Location') }}
                                </div>
                            </div>
                            <span class="block">{{ $address->address }}</span>
                        </div>
                    </div>
                    <div class="p-6 flex items-center space-x-6">
                        <a href="{{ route('customer.address.edit', ['address' => $address]) }}" 
                            class="text-semibold rounded-md bg-yellow-400 py-2 px-4 text-white hover:bg-yellow-300">
                            <i class="fi fi-rr-edit text-base"></i>
                        </a>
                        <form action="{{ route('customer.address.destroy', ['address' => $address]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <x-button class="!bg-red-600 hover:!bg-red-500">
                                <i class="fi fi-rs-trash text-base"></i>
                            </x-button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
