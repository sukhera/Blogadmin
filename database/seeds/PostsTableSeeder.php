<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Post();
        $post->title = 'Kanjar post';
        $post->content = 'Kanjari daya bachaya teri bund maar davan ga mein';
        $post->save();

        $post = new \App\Post();
        $post->title = 'yeh le bhai new post';
        $post->content = 'Jaani bahut hei kamaal kisam ki post ki hei mein ny';
        $post->save();

        $post = new \App\Post();
        $post->title = 'yeh lein bhai jaan';
        $post->content = 'Dooji post vei ho gayi hei bhai jaan';
        $post->save();

    }
}
