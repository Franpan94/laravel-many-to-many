<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++){
            $user = new User();
            $user->name = $faker->username();
            $user->email = $faker->email();
            $user->password = Hash::make($faker->password());
            $user->save();
        }
    }
}