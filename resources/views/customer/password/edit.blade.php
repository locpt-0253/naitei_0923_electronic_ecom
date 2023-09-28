<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Info') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl text-semibold">{{ __('Update Password') }}</h1>
                </div>
            </div>
            <div class="mt-5 max-w-md bg-white overflow-hidden shadow-md rounded-lg mx-auto">
                <div class="px-6 py-4 border border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form method="POST" action={{ route('customer.password.update') }}>
                    @csrf
                    @method('PUT')
                        <!-- Current Password-->
                        <div class="mt-4">
                            <x-label for="current_password" :value="__('Current Password')" />
                            <x-input id="current_password" class="block mt-1 w-full" 
                                type="password" 
                                name="current_password"
                                required autofocus />
                        </div>

                        <!-- New Password-->
                        <div class="mt-4">
                            <x-label for="new_password" :value="__('New Password')" />
                            <x-input id="new_password" class="block mt-1 w-full"
                                type="password"
                                name="new_password"
                                required complete="new-password" />
                        </div>

                        <!-- Confirm Password-->
                        <div class="mt-4">
                            <x-label for="new_password_confirmation" :value="__('Confirm Password')" />
                            <x-input id="new_password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="new_password_confirmation" required />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
