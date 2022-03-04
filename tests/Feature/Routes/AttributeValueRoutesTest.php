<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use App\Models\Attribute;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeValueRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_user_cannot_view_attribute_values()
    {
        $attribute = Attribute::factory()->create();

        $response = $this->get(route('admin.attributesValues.index', $attribute));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.attributesValues.index', $attribute));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_view_attribute_values()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.attributesValues.index', $attribute));

        $response->assertOk();
    }

    /** @test */
    public function guest_and_user_cannot_add_attribute_value()
    {
        $attribute = Attribute::factory()->create();

        $response = $this->post(route('admin.attributesValues.store', $attribute), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('admin.attributesValues.store', $attribute), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_update_attribute_value()
    {
        $attribute = Attribute::factory()->create();

        $response = $this->put(route('admin.attributesValues.update', $attribute), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->put(route('admin.attributesValues.update', $attribute), []);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /** @test */
    public function guest_and_user_cannot_delete_attribute_value()
    {
        $attribute = Attribute::factory()->create();

        $response = $this->post(route('admin.attributesValues.delete', $attribute));
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('admin.attributesValues.delete', $attribute));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
