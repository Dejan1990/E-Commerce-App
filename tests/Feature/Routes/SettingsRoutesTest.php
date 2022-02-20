<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestAndUserCannotViewSettingPage()
    {
        $response = $this->get('/admin/settings');
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/settings');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testAdminCanViewSettingPage()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get('/admin/settings');
        $response->assertOk();
    }

    public function testGuestAndUserCannotUpdateSetting()
    {
        $response = $this->post(route('admin.settings.update'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('admin.settings.update'), []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response->assertSessionMissing('success');
    }

    public function testAdminCanUpdateSetting()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->post(route('admin.settings.update'), []);
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Settings updated successfully.');
    }
}
