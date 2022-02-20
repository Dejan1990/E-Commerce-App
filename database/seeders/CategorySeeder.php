<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Root',
            'description' => 'This is the root category, don\'t delete this one',
            'parent_id' => null,
            'menu' => false
        ]);

        Category::factory(10)->create();
    }
}
