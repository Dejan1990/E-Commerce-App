<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showing_categories_on_product_index_page()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $category1 = Category::factory()->create(['name' => 'Category One']);
        $category2 = Category::factory()->create(['name' => 'Category Two']);

        $product->categories()->attach(['category_id' => $category1->id]);
        $product->categories()->attach(['category_id' => $category2->id]);

        $response = $this->actingAs($user)
            ->get(route('admin.products.index'));

        $response->assertSee('Category One', false);
        $response->assertSee('Category Two', false);
    }

    /** @test */
    public function categories_are_required_when_creating_product()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), [
                'categories' => ''
            ]);

        $response->assertSessionHasErrors([
            'categories' => 'The categories field is required.'
        ]);
    }

    /** @test */
    public function categories_stored_correctly_when_product_created()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        
        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), [
                'name' => 'Product',
                'sku' => 'PRO',
                'brand_id' => $brand->id,
                'price' => 199,
                'quantity' => 2,
                'description' => 'Product description',
                'categories' => [$category1->id, $category2->id]
            ]);

        $response->assertSessionHas('success', 'Product Created Successfully');
        $this->assertDatabaseCount('product_categories', 2);
        $this->assertDatabaseHas('product_categories', [
            'category_id' => 1,
            'product_id' => 1
        ]);
        $this->assertDatabaseHas('product_categories', [
            'category_id' => 2,
            'product_id' => 1
        ]);
    }

    /** @test */
    public function categories_are_required_when_updating_product()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.products.update', $product), [
                'categories' => ''
            ]);

        $response->assertSessionHasErrors([
            'categories' => 'The categories field is required.'
        ]);
    }

    /** @test */
    public function categories_stored_correctly_when_product_updated()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();
        $product = Product::factory()
            ->hasCategories()
            ->create(['brand_id' => $brand->id]);

        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        
        $response = $this->actingAs($user)
            ->put(route('admin.products.update', $product), [
                'name' => 'Product',
                'sku' => 'PRO',
                'brand_id' => $brand->id,
                'price' => 199,
                'quantity' => 2,
                'description' => 'Product description',
                'categories' => [$category1->id, $category2->id]
            ]);

        $response->assertSessionHas('success', 'Product Updated Successfully');
        $this->assertDatabaseCount('product_categories', 2);
        $this->assertDatabaseMissing('product_categories', ['category_id' => 1]);
        $this->assertDatabaseHas('product_categories', [
            'category_id' => 2,
            'product_id' => 1
        ]);
        $this->assertDatabaseHas('product_categories', [
            'category_id' => 3,
            'product_id' => 1
        ]);
    }

    /** @test */
    public function deleting_categories_when_product_is_deleted_works_properly()
    {
        $user = User::factory()->admin()->create();
        $brand = Brand::factory()->create();
        $product = Product::factory()
            ->hasCategories()
            ->create(['brand_id' => $brand->id]);

        $this->actingAs($user)
            ->delete(route('admin.products.delete', $product));

        $this->assertModelMissing($product);
        $this->assertDatabaseCount('product_categories', 0);
        $this->assertDatabaseMissing('product_categories', [
            'category_id' => 1
        ]);
    }
}
