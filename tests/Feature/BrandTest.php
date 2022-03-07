<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showing_text_if_have_not_brands_on_brand_index_page()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('admin.brands.index'));
        $response->assertSee('There is no brands yet!!!', false);
    }

    /** @test */
    public function showing_brands_if_exists_on_brand_index_page()
    {
        $user = User::factory()->admin()->create();
        Brand::factory()->create(['name' => 'Brand 1']);
        Brand::factory()->create(['name' => 'Brand 2']);

        $response = $this->actingAs($user)->get(route('admin.brands.index'));
        $response->assertSee('Brand 1', false);
        $response->assertSee('Brand 2', false);
    }

    /** @test */
    public function creating_brand_form_validation_works_properly()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.brands.store'), [
                'name' => ''
            ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
    }

    /** @test */
    public function creating_brand_works_properly()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.brands.store'), [
                'name' => 'Brand'
            ]);

        $response->assertRedirect(route('admin.brands.index'));
        $response->assertSessionHas('success', 'Brand Created Successfully');

        $this->assertDatabaseHas('brands', [
            'name' => 'Brand'
        ]);
    }

    /** @test */
    public function updating_brand_form_validation_works_properly()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.brands.update', $brand), [
                'name' => ''
            ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
    }

    /** @test */
    public function updating_brand_works_properly()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.brands.update', $brand), [
                'name' => 'Brand'
            ]);

        $response->assertRedirect(route('admin.brands.index'));
        $response->assertSessionHas('success', 'Brand Updated Successfully');

        $this->assertDatabaseHas('brands', [
            'name' => 'Brand'
        ]);
    }

    /** @test */
    public function deleting_brand_works_properly()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.brands.delete', $brand));

        $response->assertRedirect(route('admin.brands.index'));
        $response->assertSessionHas('success', 'Brand Deleted Successfully');

        $this->assertDatabaseCount('brands', 0);
    }
}
