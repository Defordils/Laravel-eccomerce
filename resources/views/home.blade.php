@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-gray-900">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="/placeholder.svg?height=600&width=1200" alt="Hero">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Welcome to Our Store
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl">
                Discover amazing products at unbeatable prices. Shop now and enjoy fast shipping and excellent customer service.
            </p>
            <div class="mt-10">
                <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 border border-transparent rounded-md py-3 px-8 text-base font-medium text-white hover:bg-blue-700">
                    Shop Now
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Featured Products</h2>
            <p class="mt-4 text-lg text-gray-600">Check out our most popular items</p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($featuredProducts as $product)
            <div class="group relative">
                <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
                    <img src="/placeholder.svg?height=300&width=300" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="{{ route('products.show', $product) }}">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>
                    </div>
                    <div class="text-right">
                        @if($product->isOnSale())
                            <p class="text-sm font-medium text-red-600">${{ $product->sale_price }}</p>
                            <p class="text-sm text-gray-500 line-through">${{ $product->price }}</p>
                        @else
                            <p class="text-sm font-medium text-gray-900">${{ $product->price }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Shop by Category</h2>
                <p class="mt-4 text-lg text-gray-600">Browse our product categories</p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-y-6 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categories as $category)
                <div class="group relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="w-full h-48 bg-gray-200">
                        <img src="/placeholder.svg?height=200&width=400" alt="{{ $category->name }}" class="w-full h-full object-center object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ $category->products_count }} products</p>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                            Shop Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
