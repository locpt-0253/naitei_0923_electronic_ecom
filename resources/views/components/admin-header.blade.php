<x-slot name="header">
    <div class="flex gap-5">
        <a
            href="/admin/users" 
            class="hover:cursor-pointer hover:scale-125 transition-all font-semibold text-xl leading-tight px-2 py-1 @if (request()->is('admin/users*')) text-blue-500 @endif">
            {{ __('User') }}
        </a>
        <a
            href="/admin/products"
            class="hover:cursor-pointer hover:scale-125 transition-all font-semibold text-xl leading-tight px-2 py-1 @if (request()->is('admin/product*')) text-blue-500 @endif">
            {{ __('Product') }}
        </a>
        <a
            href="/admin/orders"
            class="hover:cursor-pointer hover:scale-125 transition-all font-semibold text-xl leading-tight px-2 py-1 @if (request()->is('admin/orders*')) text-blue-500 @endif">
            {{ __('Orders') }}
        </a>
    </div>
</x-slot>
