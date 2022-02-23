<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['small', 'medium', 'large'];
        $colors = ['black', 'red', 'white'];

        foreach ($sizes as $size) {
            AttributeValue::create([
                'attribute_id' => 1,
                'value' => $size
            ]);
        }

        foreach ($colors as $color) {
            AttributeValue::create([
                'attribute_id' => 2,
                'value' => $color
            ]);
        }
    }
}
