<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Clothing', 'slug' => 'clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Books', 'slug' => 'books', 'description' => 'Books and literature'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'description' => 'Home and garden products'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports and fitness equipment'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create products
        $products = [
            [
                'name' => 'Smartphone Pro',
                'slug' => 'smartphone-pro',
                'description' => 'Latest smartphone with advanced features and high-quality camera.',
                'short_description' => 'Premium smartphone with excellent camera',
                'price' => 899.99,
                'sale_price' => 799.99,
                'sku' => 'PHONE-001',
                'stock_quantity' => 50,
                'category_id' => 1,
                'is_featured' => true
            ],
            [
                'name' => 'Wireless Headphones',
                'slug' => 'wireless-headphones',
                'description' => 'High-quality wireless headphones with noise cancellation.',
                'short_description' => 'Premium wireless headphones',
                'price' => 299.99,
                'sku' => 'HEAD-001',
                'stock_quantity' => 30,
                'category_id' => 1,
                'is_featured' => true
            ],
            [
                'name' => 'Cotton T-Shirt',
                'slug' => 'cotton-t-shirt',
                'description' => 'Comfortable cotton t-shirt available in multiple colors.',
                'short_description' => '100% cotton comfortable t-shirt',
                'price' => 29.99,
                'sale_price' => 24.99,
                'sku' => 'SHIRT-001',
                'stock_quantity' => 100,
                'category_id' => 2,
                'is_featured' => true
            ],
            [
                'name' => 'Programming Book',
                'slug' => 'programming-book',
                'description' => 'Comprehensive guide to modern web development.',
                'short_description' => 'Learn web development from scratch',
                'price' => 49.99,
                'sku' => 'BOOK-001',
                'stock_quantity' => 25,
                'category_id' => 3
            ],
            [
                'name' => 'Garden Tools Set',
                'slug' => 'garden-tools-set',
                'description' => 'Complete set of essential garden tools for home gardening.',
                'short_description' => 'Essential gardening tools set',
                'price' => 79.99,
                'sku' => 'GARDEN-001',
                'stock_quantity' => 15,
                'category_id' => 4,
                'is_featured' => true
            ],
            [
                'name' => 'Yoga Mat',
                'slug' => 'yoga-mat',
                'description' => 'Non-slip yoga mat perfect for all types of yoga practice.',
                'short_description' => 'Premium non-slip yoga mat',
                'price' => 39.99,
                'sku' => 'YOGA-001',
                'stock_quantity' => 40,
                'category_id' => 5
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
