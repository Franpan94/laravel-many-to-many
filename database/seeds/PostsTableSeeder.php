<?php

use Faker\Generator as Faker;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //

         $users = User::all();
         
        for($i = 0; $i < 50; $i++){
            $newpost = new Post();
            $newpost->user_id = $faker->randomElement($users)->id;
            $newpost->title = $faker->sentence(3);
            $newpost->post_content = $faker->paragraph(20);
            $newpost->post_image = $faker->imageUrl();
            $newpost->post_date = $faker->dateTime();
            $newpost->save();
        }
    }
}

