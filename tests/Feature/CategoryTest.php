<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_category_form_validation_work()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.categories.store'), [
                'name' => '',
                'parent_id' => 0,
                'description' => 'lo'
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'parent_id' => 'The selected parent id is invalid.',
            'description' => 'The description must be at least 3 characters.'
        ]);
    }

    /** @test */
    public function creating_a_category_works_properly()
    {
        $user = User::factory()->admin()->create();
        $file = UploadedFile::fake()->image('category.jpg');

        $response = $this->actingAs($user)
            ->post(route('admin.categories.store'), [
                'name' => 'First Category',
                'parent_id' => 1,
                'description' => 'First description',
                'image' => $file
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Category Created Successfully.');
        
        $this->assertDatabaseHas('categories', [
            'name' => 'First Category',
            'parent_id' => 1,
            'description' => 'First description',
            'image' => 'category/'.$file->hashName()
        ]);
    }

    /** @test */
    public function category_update_form_validation_works_properly()
    {
        $category = Category::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.categories.update', $category), [
                'name' => '',
                'parent_id' => null,
                'description' => 'gt'
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'parent_id',
            'description' => 'The description must be at least 3 characters.'
        ]);
    }

    /** @test */
    public function updating_a_category_works_properly()
    {
        $category = Category::factory()->create();
        $user = User::factory()->admin()->create();
        $file = UploadedFile::fake()->image('category.jpg');

        $response = $this->actingAs($user)
            ->put(route('admin.categories.update', $category), [
                'name' => 'New Name',
                'parent_id' => 2,
                'image' => $file
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Category Updated Successfully.');

        $this->assertDatabaseHas('categories', [
            'name' => 'New Name',
            'parent_id' => 2,
            'image' => 'category/'.$file->hashName()
        ]);
    }

    /** @test */
    public function deleting_a_category_works_properly()
    {
        $category = Category::factory()->create();
        $user = User::factory()->admin()->create();

        $this->assertDatabaseCount('categories', 1);

        $response = $this->actingAs($user)
            ->delete(route('admin.categories.delete', $category));

        $response->assertSessionHas('success', 'Category Deleted Successfully.');

        $this->assertDatabaseCount('categories', 0);
        //$this->assertEquals(0, Category::count());
    }

    /** @test */
    public function deleting_a_parent_category_works_properly()
    {
        $user = User::factory()->admin()->create();

        $rootCategory = Category::factory()->create();
        $categoryParent = Category::factory()->create();
        $childCategory = Category::factory()->create([
            'name' => 'child category', 
            'parent_id' => 2
        ]);

        $this->actingAs($user)
            ->delete(route('admin.categories.delete', $categoryParent));

        $this->assertDatabaseHas('categories', [
            'name' => 'child category',
            'parent_id' => 1,
        ]);
    }
}
