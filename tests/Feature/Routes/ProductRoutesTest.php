<?php

namespace Tests\Feature\Routes;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_user_cannot_view_product_page()
    {
        $response = $this->get(route('admin.products.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.products.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_product_page()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.index'));
            
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_view_create_product_page()
    {
        $response = $this->get(route('admin.products.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.products.create'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_create_product_page()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.create'));
            
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_store_product()
    {
        $response = $this->post(route('admin.products.create'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('admin.products.create'), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_view_edit_product_page()
    {
        $product = Product::factory()->forBrand()->create();

        $response = $this->get(route('admin.products.edit', $product));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.products.edit', $product));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_edit_product_page()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.edit', $product));
            
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_update_product()
    {
        $product = Product::factory()->forBrand()->create();

        $response = $this->put(route('admin.products.update', $product), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->put(route('admin.products.update', $product), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_delete_product()
    {
        $product = Product::factory()->forBrand()->create();

        $response = $this->delete(route('admin.products.delete', $product));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->delete(route('admin.products.delete', $product));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
