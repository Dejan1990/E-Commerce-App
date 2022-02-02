<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Doe',
            'email' => 'admin@mail.com',
            'is_admin' => true
        ]);
    }
}
