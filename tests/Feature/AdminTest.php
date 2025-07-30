<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_regular_user_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_create_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $productData = [
            'name' => 'Test Product',
            'description' => 'Test product description',
            'price' => 99.99,
            'category_id' => $category->id,
            'stock_quantity' => 10,
            'sku' => 'TEST-001'
        ];

        $response = $this->actingAs($admin)
            ->post('/admin/products', $productData);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99
        ]);
    }
}
