<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\User;
use App\Models\Attribute;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_user_cannot_view_attribute_page()
    {
        $response = $this->get(route('admin.attributes.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributes.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_attribute_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributes.index'));

        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_view_attribute_create_page()
    {
        $response = $this->get(route('admin.attributes.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributes.create'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_attribute_create_page()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributes.create'));

        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_store_attribute()
    {
        $response = $this->post(route('admin.attributes.store'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('admin.attributes.store'), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');
    }

    /** @test */
    public function guest_and_user_cannot_view_edit_attribute_page()
    {
        $attribute = Attribute::factory()->create();

        $response = $this->get(route('admin.attributes.edit', $attribute));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributes.edit', $attribute));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_edit_attribute_page()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.attributes.edit', $attribute));

        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_update_attribute()
    {
        $attribute = Attribute::factory()->create();
        
        $response = $this->put(route('admin.attributes.update', $attribute), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->put(route('admin.attributes.update', $attribute), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');
    }

    /** @test */
    public function guest_and_user_cannot_delete_attribute()
    {
        $attribute = Attribute::factory()->create();
        $response = $this->delete(route('admin.attributes.delete', $attribute));
        $response->assertStatus(302);
        $response->assertSessionMissing('success');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->delete(route('admin.attributes.delete', $attribute));
            
        $response->assertStatus(302);
        $response->assertSessionMissing('success');
    }
}
