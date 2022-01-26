<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $id = Category::create(['name'=>'Electronic','slug'=>'electronic'])->id;
        Category::create(['name'=>'Computer/Tablet','slug'=>'computer-tablet','up_id' => $id]);
        Category::create(['name'=>'Phone','slug'=>'phone','up_id' => $id]);
        Category::create(['name'=>'TV and Sound Systems','slug'=>'tv-sound-systems','up_id' => $id]);
        Category::create(['name'=>'Camera','slug'=>'camera','up_id' => $id]);

        $id = Category::create(['name'=>'Book','slug'=>'book'])->id;
        Category::create(['name'=>'Literature','slug'=>'literature','up_id'=>$id]);
        Category::create(['name'=>'Mathematics','slug'=>'mathematics','up_id'=>$id]);
        Category::create(['name'=>'Preparation for Exams','slug'=>'preparation-exams','up_id'=>$id]);

        Category::create(['name'=>'Magazine','slug'=>'magazine']);
        Category::create(['name'=>'Furniture','slug'=>'furniture']);
        Category::create(['name'=>'Decoration','slug'=>'decoration']);
        Category::create(['name'=>'Cosmetic','slug'=>'cosmetic']);
        Category::create(['name'=>'Personal care','slug'=>'personal-care']);
        Category::create(['name'=>'Clothing and Fashion','slug'=>'clothing-fashion']);
        Category::create(['name'=>'Personal care','slug'=>'personal-care']);
        Category::create(['name'=>'Mother and Child','slug'=>'mother-child']);
    }
}
