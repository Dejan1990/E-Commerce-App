<?php

namespace Tests\Feature\Routes;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUsersRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestAndUserCannotViewDashboardPage()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testAdminCanViewDashboardPage()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertOk();
    }
}
