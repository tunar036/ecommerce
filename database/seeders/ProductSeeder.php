<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDetail;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
         Product::truncate();
         ProductDetail::truncate();

            for($i = 0; $i < 30 ; $i++){
                $product_name = $faker->sentence(2);
                $product = Product::create([
                    'name' => $product_name,
                    'slug' => Str::slug($product_name),
                    'desc' => $faker->sentence(10),
                    'price' => $faker->randomFloat(3,1,20)
                ]);

                $detail = $product->detail()->create([
                    'show_slider'=>rand(0,1),
                    'show_opportunity'=>rand(0,1),
                    'show_featured'=>rand(0,1),
                    'show_bestselling'=>rand(0,1),
                    'show_discount'=>rand(0,1)
                ]);
            }
            DB::statement("SET FOREIGN_KEY_CHECKS=1;");

    }
}
