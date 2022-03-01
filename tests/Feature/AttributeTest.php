<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Attribute;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_attribute_form_validation_work()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.attributes.store'), [
                'code' => '',
                'name' => '',
                'frontend_type' => 0
        ]);

        $response->assertSessionHasErrors([
            'code' => 'The code field is required.',
            'name' => 'The name field is required.',
            'frontend_type' => 'The selected frontend type is invalid.'
        ]);
    }

    /** @test */
    public function creating_an_attribute_works_properly()
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.attributes.store'), [
                'code' => 'color',
                'name' => 'Color',
                'frontend_type' => 'select'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success', 'Attribute Created Successfully.');
        $response->assertRedirect(route('admin.attributes.index'));

        $this->assertDatabaseHas('attributes', [
            'code' => 'color',
            'name' => 'Color',
            'frontend_type' => 'select'
        ]);
    }

    /** @test */
    public function attribute_update_form_validation_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.attributes.update', $attribute), [
                'code' => '',
                'name' => '',
                'frontend_type' => 0
        ]);

        $response->assertSessionHasErrors([
            'code' => 'The code field is required.',
            'name' => 'The name field is required.',
            'frontend_type' => 'The selected frontend type is invalid.'
        ]);
    }

    /** @test */
    public function updating_an_attribute_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.attributes.update', $attribute), [
                'code' => 'new code',
                'name' => 'new name',
                'frontend_type' => 'select'
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.attributes.index'));
        $response->assertSessionHas('success', 'Attribute Updated Successfully.');

        $this->assertDatabaseHas('attributes', [
            'code' => 'new code',
            'name' => 'new name',
            'frontend_type' => 'select'
        ]);
    }

    /** @test */
    public function deleting_an_attribute_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $this->assertDatabaseCount('attributes', 1);

        $response = $this->actingAs($user)
            ->delete(route('admin.attributes.delete', $attribute));

        $response->assertSessionHas('success', 'Attribute Deleted Successfully.');
        $response->assertRedirect(route('admin.attributes.index'));

        $this->assertDatabaseCount('attributes', 0);
    }
}
