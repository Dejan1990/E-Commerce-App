<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function images_are_required_when_uploading_product_images()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.images.upload'), [
                'product_id' => $product->id,
                'image' => ''
            ]);

        $response->assertSessionHasErrors('image');
        $this->assertDatabaseCount('product_images', 0);
    }

    /** @test */
    public function creating_a_product_images_work_properly()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();
        $image = UploadedFile::fake()->image('product.jpg');

        $response = $this->actingAs($user)
            ->post(route('admin.products.images.upload'), [
                'product_id' => $product->id,
                'image' => $image
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('product_images', 1);
        $this->assertDatabaseHas('product_images', [
            'product_id' => 1,
            'image' => 'product/'.$image->hashName()
        ]);
    }

    /** @test */
    public function deleting_a_product_images_work_properly()
    {
        $user = User::factory()->admin()->create();
        $product = Product::factory()->forBrand()->create();

        $productImage = ProductImage::create([
            'product_id' => $product->id,
            'image' => 'product/product.jpg'
        ]);

        $this->assertModelExists($productImage);
        
        $response = $this->actingAs($user)
            ->get(route('admin.products.images.delete', $productImage->id));

        $this->assertModelMissing($productImage);
    }
}
