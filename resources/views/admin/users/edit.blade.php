<x-app-layout>
    @include('components.admin-header');

    <div class="py-36">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-10 ">
                        <div
                            class="col-span-4 text-center max-h-[450px] max-w-[450px] bg-gray-100 rounded-full flex items-center">
                            <i class="mx-auto fi fi-sr-user text-9xl text-slate-600"></i>
                        </div>

                        <div class="container mx-auto col-span-6">
                            <div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-300">
                                <h2 class="text-2xl font-semibold mb-6">
                                    {{ __('Edit :resource', ['resource' => __('User')]) }}</h2>
                                @include('components.message')
                                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label for="first_name"
                                            class="block text-sm font-medium text-gray-700">{{ __('First Name') }}</label>
                                        <input id="first_name" type="text"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('first_name') border-red-500 @enderror"
                                            name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                            required autofocus>
                                    </div>

                                    <div class="mb-4">
                                        <label for="last_name"
                                            class="block text-sm font-medium text-gray-700">{{ __('Last Name') }}</label>
                                        <input id="last_name" type="text"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('last_name') border-red-500 @enderror"
                                            name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="gender"
                                            class="block text-sm font-medium text-gray-700">{{ __('Gender') }}</label>
                                        <select id="gender" name="gender"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('gender') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Select Gender --</option>
                                            <option value="1"
                                                {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>
                                                {{ __('Male') }}</option>
                                            <option value="2"
                                                {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>
                                                {{ __('Female') }}</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="email"
                                            class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                                        <input id="email" type="email"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror"
                                            name="email" value="{{ old('email', $user->email) }}" required
                                            autocomplete="email" autofocus>
                                    </div>

                                    <div class="mb-4">
                                        <label for="role_id"
                                            class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
                                        <select id="role_id" name="role_id"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('role') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Select Role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-6">
                                        <x-button type="submit"
                                            class="inline-block px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none">
                                            {{ __('Update') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
