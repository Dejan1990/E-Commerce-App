<?php

namespace Tests\Feature\Routes;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_user_cannot_view_brand_page()
    {
        $response = $this->get(route('admin.brands.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.brands.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_brand_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('admin.brands.index'));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_view_create_brand_page()
    {
        $response = $this->get(route('admin.brands.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.brands.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_create_brand_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('admin.brands.create'));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_store_brand()
    {
        $response = $this->post(route('admin.brands.store'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('admin.brands.store'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_view_edit_brand_page()
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('admin.brands.edit', $brand));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.brands.edit', $brand));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_edit_brand_page()
    {
        $brand = Brand::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('admin.brands.edit', $brand));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_update_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->put(route('admin.brands.update', $brand), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->put(route('admin.brands.update', $brand), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_delete_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('admin.brands.delete', $brand));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('admin.brands.delete', $brand));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
