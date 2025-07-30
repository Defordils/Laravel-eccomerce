<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 min-h-screen">
                <div class="p-4">
                    <h2 class="text-white text-xl font-bold">Admin Panel</h2>
                </div>
                <nav class="mt-8">
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                        Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                        Orders
                    </a>
                    <a href="{{ route('home') }}" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                        View Store
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Top Navigation -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center">
                            <h1 class="text-3xl font-bold text-gray-900">@yield('title', 'Dashboard')</h1>
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
