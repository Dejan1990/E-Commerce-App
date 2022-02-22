<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_user_cannot_view_category_page()
    {
        $response = $this->get(route('admin.categories.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_category_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_view_category_create_page()
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_category_create_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.create'));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_store_category()
    {
        $response = $this->post(route('admin.categories.store'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('admin.categories.store'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');
    }

    /** @test */
    public function guest_and_user_cannot_view_edit_category_page()
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.edit', $category));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.edit', $category));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_edit_category_page()
    {
        $category = Category::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get(route('admin.categories.edit', $category));
        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_update_category()
    {
        $category = Category::factory()->create();
        $response = $this->put(route('admin.categories.update', $category));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->put(route('admin.categories.update', $category));
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->delete(route('admin.categories.delete', $category));
        $response->assertStatus(302);
        $response->assertSessionMissing('success');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('admin.categories.delete', $category));
        $response->assertStatus(302);
        $response->assertSessionMissing('success');
    }
}
