<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeValueTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_attribute_value_form_validation_work()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.attributesValues.store', $attribute), [
                'value' => ''
            ]);

        $response->assertSessionHasErrors('value');
    }

    /** @test */
    public function creating_an_attribute_value_works_properly()
    {
        $attribute = Attribute::factory()->create(['id' => 5]);
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.attributesValues.store', $attribute), [
                'value' => 'new value'
            ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('attribute_values', [
            'attribute_id' => 5,
            'value' => 'new value'
        ]);
    }

    /** @test */
    public function attribute_value_update_form_validation_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();
        $value = AttributeValue::create([
            'attribute_id' => $attribute->id,
            'value' => 'value'
        ]);

        $response = $this->actingAs($user)
            ->put(route('admin.attributesValues.update', $attribute), [
                'value' => '',
                'valueId' => $value->id
            ]);

        $response->assertSessionHasErrors('value');
    }

    /** @test */
    public function updating_an_attribute_value_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();
        $value = AttributeValue::create([
            'attribute_id' => $attribute->id,
            'value' => 'value'
        ]);

        $response = $this->actingAs($user)
            ->put(route('admin.attributesValues.update', $attribute), [
                'value' => 'new value',
                'valueId' => $value->id
            ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('attribute_values', [
            'value' => 'new value'
        ]);
    }

    /** @test */
    public function deleting_an_attribute_value_works_properly()
    {
        $attribute = Attribute::factory()->create();
        $user = User::factory()->admin()->create();
        $value = AttributeValue::create([
            'attribute_id' => $attribute->id,
            'value' => 'value'
        ]);

        $this->assertDatabaseCount('attribute_values', 1);

        $response = $this->actingAs($user)
            ->post(route('admin.attributesValues.delete', $attribute), [
                'valueId' => $value->id
            ]);

        $this->assertDatabaseCount('attribute_values', 0);
    }
}
