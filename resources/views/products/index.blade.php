@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Products</h1>
        
        <!-- Search and Sort -->
        <div class="flex space-x-4">
            <form method="GET" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="border border-gray-300 rounded-l-md px-4 py-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Search</button>
            </form>
            
            <select name="sort" onchange="window.location.href='{{ route('products.index') }}?sort=' + this.value" class="border border-gray-300 rounded-md px-4 py-2">
                <option value="">Sort by</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($products as $product)
        <div class="group relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="w-full h-64 bg-gray-200">
                <img src="/placeholder.svg?height=250&width=300" alt="{{ $product->name }}" class="w-full h-full object-center object-cover group-hover:opacity-75">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-900">
                    <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                <div class="mt-2 flex justify-between items-center">
                    <div>
                        @if($product->isOnSale())
                            <span class="text-lg font-medium text-red-600">${{ $product->sale_price }}</span>
                            <span class="text-sm text-gray-500 line-through ml-2">${{ $product->price }}</span>
                        @else
                            <span class="text-lg font-medium text-gray-900">${{ $product->price }}</span>
                        @endif
                    </div>
                    <a href="{{ route('products.show', $product) }}" class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700">
                        View
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
