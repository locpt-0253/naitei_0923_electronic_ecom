<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-[120px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h1 class="text-2xl font-semibold mb-5">DANH MỤC</h1>
                    <div class="grid grid-cols-11 gap-1">
                        <a href="/" class="flex flex-col items-center hover:bg-slate-100 border-2 border-gray-100 shadow-md p-2">
                            <div class="shrink max-h-[80px] py-2">
                                <img class="max-w-full max-h-full align-middle" src="/storage/default_product.png" />
                            </div>
                            <span class="block mt-2 text-center font-semibold">Tên danh mục</span>
                            <span class="block mt-1 text-center text-sm">30 sản phẩm</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-5">TÌM KIẾM HÀNG ĐẦU</h1>
                    <div class="grid grid-cols-5 gap-1">
                        <a href="/" class="flex flex-col justify-between hover:bg-slate-100 border-2 border-gray-100 shadow-md p-2 hover:scale-105">
                            <div class="shrink max-h-[180px] py-2 self-center">
                                <img class="max-w-full max-h-full align-middle" src="/storage/default_product.png" />
                            </div>
                            <div class="shrink self-stretch">
                                <div class="max-h-[72px] mt-2 text-left">
                                    <span class="font-semibold line-clamp-2">Tên sản phẩm</span>
                                </div>
                                <span class="block mt-1 text-left text-sm text-yellow-400">
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="block mt-1 text-left text-lg">
                                    100.000VND
                                </span>
                                <span class="block mt-1 text-left text-xs">
                                    Đã bán 1000
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-5">SẢN PHẨM NỔI BẬT</h1>
                    <div class="grid grid-cols-5 gap-1">
                        <a href="/" class="flex flex-col justify-between hover:bg-slate-100 border-2 border-gray-100 shadow-md p-2 hover:scale-105">
                            <div class="shrink max-h-[180px] py-2 self-center">
                                <img class="max-w-full max-h-full align-middle" src="/storage/default_product.png" />
                            </div>
                            <div class="shrink self-stretch">
                                <div class="max-h-[72px] mt-2 text-left">
                                    <span class="font-semibold line-clamp-2">Tên sản phẩm</span>
                                </div>
                                <span class="block mt-1 text-left text-sm text-yellow-400">
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                    <i class="fi fi-ss-star"></i>
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="block mt-1 text-left text-lg">
                                    100.000VND
                                </span>
                                <span class="block mt-1 text-left text-xs">
                                    Đã bán 1000
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
