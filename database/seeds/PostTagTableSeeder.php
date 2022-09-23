<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;


class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $randomTags = Tag::inRandomOrder()->limit(2)->get();
            $post->tags()->attach($randomTags);
        }
    }
}
