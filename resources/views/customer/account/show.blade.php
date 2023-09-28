<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Info') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="flex flex-nowrap justify-between box-border container">
                        <div id="info-left" class="p-4 w-[720px] box-border">
                            <span class="text-base font-normal text-gray-500 ">{{ __('Profile') }}</span>
                            <div class="mt-4 rounded-md bg-white box-border">
                                <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="box-border flex flex-row">
                                        <div class="block box-border mr-4">
                                            <div class="flex items-center flex-col">
                                                <div class="flex items-center my-5 h-[100px] w-[100px] justify-center relative">
                                                    <img class="rounded-full cursor-pointer block max-w-full max-h-full object-scale-down"
                                                        src="{{ $user->image->image_url }}">
                                                </div>
                                                <input name="avatar_image" type="file" accept=".jpg,.jpeg,.png" class="max-w-[170px]"/>
                                            </div>
                                        </div>
                                        <div class="flex flex-col w-full justify-between box-border">

                                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                            <!-- First Name -->
                                            <div class="mb-8 flex items-center">
                                                <label class="min-w-[110px] text-base text-gray-700 mr-4">
                                                    {{ __('First Name') }}
                                                </label>
                                                <div class="flex flex-1 relative">
                                                    <div class="box-border w-full">
                                                        <x-input type="search" name="first_name" maxlength="128" 
                                                            placeholder="{{ __('Fill in your first name') }}" :value="$user->first_name"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="mb-8 flex items-center">
                                                <label class="min-w-[110px] text-base text-gray-700 mr-4">
                                                    {{ __('Last Name') }}
                                                </label>
                                                <div class="flex flex-1 relative">
                                                    <div class="box-border w-full">
                                                        <x-input type="search" name="last_name" maxlength="128" 
                                                            placeholder="{{ __('Fill in your last name') }}" :value="$user->last_name"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Gender -->
                                            <div class="mb-8 flex items-center">
                                                <label class="min-w-[110px] text-base text-gray-700 mr-4">
                                                    {{ __('Gender') }}
                                                </label>
                                                <div class="box-border w-full flex items-center">
                                                    <input type="radio" name="gender" class="mr-2" value="male" 
                                                        @if($user->gender == config('app.gender.male')) checked @endif/>
                                                    <label class="text-center ">{{ __('Male') }}</label>
                                                </div>
                                                <div class="box-border w-full flex items-center">
                                                    <input type="radio" name="gender" class="mr-2" value="female"
                                                        @if($user->gender == config('app.gender.female')) checked @endif/>
                                                    <label class="text-center ">{{ __('Female') }}</label>
                                                </div>
                                                <div class="box-border w-full flex items-center">
                                                    <input type="radio" name="gender" class="mr-2" value="other"
                                                        @if($user->gender == config('app.gender.other')) checked @endif/>
                                                    <label class="text-center ">{{ __('Other') }}</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Email -->
                                            <div class="mb-8 flex items-center">
                                                <label class="min-w-[110px] text-base text-gray-700 mr-4 flex items-center space-x-2">
                                                    <i class="fi fi-rr-envelope block"></i>
                                                    <span class="ml-2 block">{{ _('Email') }}</span>
                                                </label>
                                                <div class="flex flex-1 relative">
                                                    <div class="box-border w-full">
                                                        <x-input type="search" name="email" maxlength="128" 
                                                            placeholder="{{ __('Fill in your email') }}" :value="$user->email"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Save button -->
                                            <div class="mb-8 flex items-center">
                                                <div class="flex flex-1 relative">
                                                    <div class="box-border w-full">
                                                        <x-button class="!bg-blue-700 text-white">
                                                            {{ __('Save') }}
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="info-vertical" class="border-l-gray-500 border-l"></div>
                        <div id="info-right" class="py-6 px-4 flex flex-col" style="width:calc(100% - 720px)">
    
                            <div class="flex justify-between">
                                <span class="text-base text-gray-500 block">{{ __('Phone Number') }} {{ __('and') }} {{ __('Address') }}</span>
                                <a href="{{ route('customer.address.index') }}"
                                    class="py-1.5 px-4 border-blue-600 border rounded-sm text-blue-600">
                                    {{ __('View') }}
                                </a>
                            </div>
                            @foreach($user->addresses as $address)
                            <div class="py-4 border-b border-b-gray-300">
                                <div class="py-1 flex items-center justify-between text-gray-700">
                                    <div class="flex flex-nowrap justify-start space-x-4">
                                        <i class="fi fi-rr-id-card-clip-alt"></i>
                                        <div class="flex flex-col">
                                            {{ __('Name') }}
                                        </div>
                                    </div>
                                    <x-input type="search" name="name" :value="$address->name" />
                                </div>
                                <div class="py-1 flex items-center justify-between text-gray-700">
                                    <div class="flex flex-nowrap justify-start space-x-4">
                                        <i class="fi fi-rr-phone-flip"></i>
                                        <div class="flex flex-col">
                                            {{ __('Phone Number') }}
                                        </div>
                                    </div>
                                    <x-input type="search" name="phone" :value="$address->phone" />
                                </div>
                                <div class="py-1 flex items-center justify-between text-gray-700">
                                    <div class="flex flex-nowrap justify-start space-x-4">
                                        <i class="fi fi-rs-marker"></i>
                                        <div class="flex flex-col">
                                            {{ __('Location') }}
                                        </div>
                                    </div>
                                    <x-input type="search" name="address" :value="$address->address" />
                                </div>
                            </div>
                            @endforeach

                            <span class="text-base text-gray-500">{{ __('Security') }}</span>
                            <div class="py-5 flex items-center justify-between text-gray-700">
                                <div class="flex flex-nowrap justify-start space-x-4">
                                    <i class="fi fi-rr-lock"></i>
                                    <div class="flex flex-col">
                                        {{ __('Change Password') }}
                                    </div>
                                </div>
                                <a href="{{ route('customer.password.edit') }}"
                                    class="py-1.5 px-4 border-blue-600 border rounded-sm text-blue-600">
                                    {{ __('Update') }}
                                </a>
                            </div>

                            <span class="text-base text-gray-500">{{ __('Social Network Link') }}</span>
                            <div class="py-4 flex items-center justify-between text-gray-700">
                                <div class="flex flex-nowrap justify-start space-x-4">
                                    <i class="fi fi-brands-facebook text-blue-700"></i>
                                    <div class="flex flex-col">
                                        {{ __('Facebook') }}
                                    </div>
                                </div>
                                <a href="/"
                                    class="py-1.5 px-4 border-blue-600 border rounded-sm text-blue-600">
                                    {{ __('Update') }}
                                </a>
                            </div>
                            <div class="py-4 flex items-center justify-between text-gray-700">
                                <div class="flex flex-nowrap justify-start space-x-4">
                                    <i class="fi fi-brands-google text-red-500"></i>
                                    <div class="flex flex-col">
                                        {{ __('Google') }}
                                    </div>
                                </div>
                                <a href="/"
                                    class="py-1.5 px-4 border-blue-600 border rounded-sm text-blue-600">
                                    {{ __('Update') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
