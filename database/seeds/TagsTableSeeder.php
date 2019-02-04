<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new \App\Tag();
        $tag->name('test1');
        $tag->save();

        $tag = new \App\Tag();
        $tag->name('Hot');
        $tag->save();


    }
}
