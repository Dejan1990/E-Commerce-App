<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function showing_text_if_have_not_products_on_product_index_page()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.index'));

        $response->assertSee('There is no product yet!!!', false);
    }

    /** @test */
    public function showing_products_if_exists_on_product_index_page()
    {
        $user = User::factory()->admin()->create();
        Product::factory()->forBrand()->create(['name' => 'Product 1']);
        Product::factory()->forBrand()->create(['name' => 'Product 2']);

        $response = $this->actingAs($user)
            ->get(route('admin.products.index'));

        $response->assertDontSee('There is no product yet!!!', false);
        $response->assertSee('Product 1', false);
        $response->assertSee('Product 2', false);
    }

    /** @test */
    public function creating_product_form_validation_works_properly()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.store'), [
                'name' => '',
                'sku' => '',
                'brand_id' => 0,
                'price' => '',
                'quantity' => '',
                'description' => 'as',
                'categories' => ''
            ]);

        $response->assertSessionHasErrors([
            'name', 'sku', 'brand_id', 'categories', 'price', 'quantity', 'description'
        ]);
    }

    /** @test */
    public function creating_product_works_properly()
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

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product Created Successfully');

        $this->assertDatabaseHas('products', [
            'name' => 'Product',
            'sku' => 'PRO',
            'brand_id' => 1,
            'price' => 199,
            'quantity' => 2,
            'description' => 'Product description'
        ]);

        $this->assertDatabaseCount('product_categories', 2);
    }

    /** @test */
    public function updating_product_form_validation_works_properly()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.products.update', $product), [
                'name' => '',
                'sku' => '',
                'brand_id' => 0,
                'price' => '',
                'quantity' => '',
                'description' => 'as'
            ]);

        $response->assertSessionHasErrors([
            'name', 'sku', 'brand_id', 'categories', 'price', 'quantity', 'description'
        ]);
    }

    /** @test */
    public function updating_product_works_properly()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.products.update', $product), [
                'name' => 'Updated product', 
                'sku' => 'Updated',
                'brand_id' => $brand->id,
                'price' => 155,
                'quantity' => 5,
                'description' => 'Updated product description',
                'categories' => $category->id,
                'status' => 1
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Product Updated Successfully');

        $this->assertDatabaseHas('products', [
            'name' => 'Updated product',
            'sku' => 'Updated',
            'brand_id' => 2,
            'price' => 155,
            'quantity' => 5,
            'description' => 'Updated product description',
            'status' => 1
        ]);
    }

    /** @test */
    public function deleting_product_works_properly()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.products.delete', $product));

        $response->assertSessionHas('success', 'Product Deleted Successfully');
        $this->assertModelMissing($product);
    }
}
