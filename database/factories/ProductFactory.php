<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $price = $this->faker->randomFloat(2, 10, 1000);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            'price' => $price,
            'sale_price' => $this->faker->boolean(30) ? $price * 0.8 : null,
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(1000, 9999),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::factory(),
            'is_active' => true,
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}
