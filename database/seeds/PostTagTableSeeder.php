<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;
use Faker\Generator as Faker;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        $tags = Tag::all();


        foreach ($tags as $tag) {
            $randomPosts = $faker->randomElements($posts, 2, false);

            foreach ($randomPosts as $randomPost) {
                $tag->posts()->attach($randomPost->id);
            }
        }
    }
}
