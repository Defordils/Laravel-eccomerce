<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_displays_products()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_product_detail_page_shows_product_information()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->get("/products/{$product->slug}");

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee('$' . $product->price);
    }

    public function test_authenticated_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)
            ->post("/cart/add/{$product->id}", ['quantity' => 2]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }

    public function test_guest_cannot_add_product_to_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->post("/cart/add/{$product->id}", ['quantity' => 1]);

        $response->assertRedirect('/login');
    }
}
