@extends('layouts.app')

@section('title', 'Products - Cavelli Atelier')

@section('content')
    <main class="flex-1 bg-gray-50 overflow-auto">
        <div class="bg-gray-100 border border-gray-300 shadow-sm rounded-2xl p-6 lg:p-10 m-4 lg:m-10 mb-px">
            <form method="GET" action="{{ route('products.index') }}">
                <h1 class="font-semibold text-lg p-4">Products</h1>

                {{-- Top bar: search, status, sort, add button --}}
                <div class="flex flex-wrap items-center gap-3 lg:gap-4 mb-6">
                    <div class="relative grow min-w-[160px]">
                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-gray-400">
                            <i class="fa fa-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search" maxlength="50"
                            class="w-full bg-gray-200 rounded-full py-2.5 pl-11 pr-12 text-sm font-medium" />
                    </div>

                    <div class="relative inline-block shrink-0">
                        <select name="status" class="appearance-none bg-gray-200 rounded-full py-2.5 pl-4 pr-12 text-gray-600 text-sm font-medium cursor-pointer">
                            <option value="">Show: All products</option>
                            <option value="active"   {{ request('status') == 'active'   ? 'selected' : '' }}>Show: Active only</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Show: Inactive only</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700">
                            <i class="fa fa-chevron-down text-sm"></i>
                        </div>
                    </div>

                    <div class="relative inline-block shrink-0">
                        <select name="sort" class="appearance-none bg-gray-200 rounded-full py-2.5 pl-4 pr-12 text-gray-600 text-sm font-medium cursor-pointer">
                            <option value="">Sort by: Default</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by: Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Sort by: Oldest</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700">
                            <i class="fa fa-chevron-down text-sm"></i>
                        </div>
                    </div>

                    <a href="{{ route('products.create') }}"
                        class="shrink-0 bg-[#8eb88e] hover:bg-[#7a9e7a] text-white px-4 py-2.5 rounded-full flex items-center gap-2 transition-colors text-sm">
                        <span class="text-xl leading-none">+</span> Add new product
                    </a>
                </div>

                <hr class="border-gray-300 -mx-6 mb-6">

                {{-- Filter row: wraps to new lines at 200% zoom --}}
                <div class="flex flex-wrap gap-4 lg:gap-6 items-end">
                    <div class="flex flex-col gap-2">
                        <label class="font-bold text-gray-800 text-sm ml-4">Product type</label>
                        <div class="relative">
                            <select name="type" class="appearance-none bg-gray-200 rounded-full py-2.5 pl-4 pr-12 text-gray-600 text-sm font-medium cursor-pointer">
                                <option value="">Show: All types</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                        Show: {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700">
                                <i class="fa fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="font-bold text-gray-800 text-sm ml-4">Price</label>
                        <div class="relative">
                            <select name="price" class="appearance-none bg-gray-200 rounded-full py-2.5 pl-4 pr-12 text-gray-600 text-sm font-medium cursor-pointer">
                                <option value="">Sort: Default</option>
                                <option value="low"  {{ request('price') == 'low'  ? 'selected' : '' }}>Sort: Low to High</option>
                                <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>Sort: High to Low</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700">
                                <i class="fa fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="font-bold text-gray-800 text-sm ml-4">Material</label>
                        <div class="relative">
                            <select name="material" class="appearance-none bg-gray-200 rounded-full py-2.5 pl-4 pr-12 text-gray-600 text-sm font-medium cursor-pointer">
                                <option value="">Show by: All</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" {{ request('material') == $material->id ? 'selected' : '' }}>
                                        Show by: {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-700">
                                <i class="fa fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="shrink-0 bg-[#8eb88e] hover:bg-[#7a9e7a] text-white px-4 py-2.5 rounded-full text-sm font-medium transition-colors">
                        Apply Filters
                    </button>
                    <a href="{{ route('products.index') }}"
                        class="shrink-0 text-sm text-gray-500 hover:text-gray-700 underline self-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Products list --}}
        <div class="p-4 lg:p-10">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="text-center p-20 bg-white rounded-2xl border border-gray-200">
                    <p class="text-gray-500 italic">No furniture matches your search. Try adjusting the filters!</p>
                </div>
            @endforelse

            <div class="mt-8 p-4 bg-white rounded-xl shadow-sm border border-gray-200">
                {{ $products->links() }}
            </div>
        </div>
    </main>
@endsection