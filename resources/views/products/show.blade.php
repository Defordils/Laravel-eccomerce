@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Image gallery -->
        <div class="flex flex-col-reverse">
            <div class="w-full aspect-w-1 aspect-h-1">
                <img src="/placeholder.svg?height=500&width=500" alt="{{ $product->name }}" class="w-full h-full object-center object-cover sm:rounded-lg">
            </div>
        </div>

        <!-- Product info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>

            <div class="mt-3">
                <h2 class="sr-only">Product information</h2>
                @if($product->isOnSale())
                    <p class="text-3xl text-red-600">${{ $product->sale_price }}</p>
                    <p class="text-lg text-gray-500 line-through">${{ $product->price }}</p>
                @else
                    <p class="text-3xl text-gray-900">${{ $product->price }}</p>
                @endif
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            @auth
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                @csrf
                <div class="mt-10 flex sm:flex-col1">
                    <div class="flex items-center">
                        <label for="quantity" class="mr-3 text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" class="border border-gray-300 rounded-md px-3 py-2 w-20">
                    </div>
                    <button type="submit" class="mt-4 sm:mt-0 sm:ml-4 flex-1 bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add to Cart
                    </button>
                </div>
            </form>
            @else
            <div class="mt-6">
                <a href="{{ route('login') }}" class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700">
                    Login to Purchase
                </a>
            </div>
            @endauth

            <div class="mt-6">
                <div class="flex items-center">
                    <span class="text-sm text-gray-500">Category: </span>
                    <span class="ml-2 text-sm font-medium text-gray-900">{{ $product->category->name }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-sm text-gray-500">SKU: </span>
                    <span class="ml-2 text-sm font-medium text-gray-900">{{ $product->sku }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-sm text-gray-500">Stock: </span>
                    <span class="ml-2 text-sm font-medium text-gray-900">{{ $product->stock_quantity }} available</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Related products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($relatedProducts as $relatedProduct)
            <div class="group relative">
                <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
                    <img src="/placeholder.svg?height=300&width=300" alt="{{ $relatedProduct->name }}" class="w-full h-full object-center object-cover">
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="{{ route('products.show', $relatedProduct) }}">
                                {{ $relatedProduct->name }}
                            </a>
                        </h3>
                    </div>
                    <p class="text-sm font-medium text-gray-900">${{ $relatedProduct->getCurrentPrice() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
