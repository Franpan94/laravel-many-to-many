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
            '#Funny', 
            '#Ironic',
            '#Quick',
            '#2022',
            '#Dragon-ball',
            '#Il-signore-degli-anelli',
            '#Calcio',
            '#Basket',
            '#Volley'
        ];

        foreach($tags as $tag){
            $newtag = new Tag();
            $newtag->name = $tag;
            $newtag->save();
        } 
    }
}
