<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'funny', 
            'ironic',
            'quick',
            '2022',
            'dragonball',
            'ilsignoredeglianelli',
        ];

        foreach($tags as $tag){
            $newtag = new Tag();
            $newtag->name = $tag;
            $newtag->save();
        } 
    }
}
