<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->delete();

        $categoryIds = Category::all()->pluck('id');

        foreach (Product::all() as $product)
        {
            for ($i=0; $i < rand(0, count($categoryIds)); $i++) { 
               $product->categories()->detach($categoryIds[$i]);
               $product->categories()->attach($categoryIds[$i]);
            }
        }
    }
}
