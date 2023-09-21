<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-5">
            <h2 class="hover:cursor-pointer font-semibold text-xl leading-tight px-2 py-1 @if(request()->is('admin/users*')) text-blue-500 @endif">
                {{ __('User') }}
            </h2>
            <h2 class="hover:cursor-pointer font-semibold text-xl leading-tight px-2 py-1 @if(request()->is('admin/product*')) text-blue-500 @endif">
                {{ __('Product') }}
            </h2>
        </div>
    </x-slot>

    <div class="pt-36">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 pb-0 bg-white border-b border-gray-200">
                    <div class="wrapper">
                        @include('components.message')
                        <div class="table">
                            <div class="row header green">
                                <div class="cell">ID</div>
                                <div class="cell">{{ __('First Name') }}</div>
                                <div class="cell">{{ __('Last Name') }}</div>
                                <div class="cell">{{ __('Gender') }}</div>
                                <div class="cell">{{ __('Email') }}</div>
                                <div class="cell">{{ __('Role') }}</div>
                                <div class="cell">{{ __('Action') }}</div>
                            </div>

                            @foreach ($users as $index => $user)
                            <div class="row">
                                <div class="cell">{{ $user->id }}</div>
                                <div class="cell">{{ $user->first_name }}</div>
                                <div class="cell">{{ $user->last_name }}</div>
                                <div class="cell">{{ array_search($user->gender, config('app.gender')) }}</div>
                                <div class="cell">{{ $user->email }}</div>
                                <div class="cell">{{ $user['role']['name'] }}</div>
                                <div class="cell flex gap-2">
                                    <x-button class="bg-blue-600" onclick="window.location.href='{{ route('admin.users.edit', ['user' => $user->id]) }}'">
                                        {{__('Edit')}}
                                    </x-button>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Delete Confirm') }}')">
                                    @csrf
                                    @method('DELETE')

                                    <x-button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
