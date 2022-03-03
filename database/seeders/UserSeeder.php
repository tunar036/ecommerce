<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        User::truncate();
        UserDetail::truncate();

        $user_admin = User::create([
            'name' => "TUnar",
            'email'=> 'admin@email.com',
            'password' => bcrypt('admin'),
            'is_active' => 1,
            'is_admin' => 1
        ]);

        $user_admin->user_detail()->create([
            'address'=>'Baki',
            'phone' => '0555555555'
        ]);

        for ($i=0; $i < 50 ; $i++) { 
            $user_customer = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'is_active' => 1,
                'is_admin' => 0
            ]);

            $user_customer->user_detail()->create([
                'address' => $faker->address,
                'phone' => $faker->phoneNumber
            ]);
        }
        
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
