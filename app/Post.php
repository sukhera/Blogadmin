<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model {

    protected $fillable = ['title', 'content'];

    public function likes(){

        return $this->hasMany('App\Like');
    }

    public function tags(){

        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getPosts($session){
        if(!$session->has('posts')){
        $posts = $this->createDummyPosts();
        $session->put('posts', $posts);

        }
        return $session->get('posts');
    }

    private function createDummyPosts(){
     $posts = [
        ['title' => 'Learning Laravel',
            'content' => 'This is the first step'],
        ['title' => 'second Laravel',
            'content' => 'This is the second step']
        ];
        return $posts;
    }

    public function getPost($session,$id){
        if(!$session->has('posts')){
            $posts = $this->createDummyPosts();
            $session->put('posts', $posts);
        }
        return $session->get('posts')[$id];
    }

    public function addPost($session, $title, $content){
        if(!$session->has('posts')){
            $posts = $this->createDummyPosts();
            $session->put('posts', $posts);
        }
        $posts = $session->get('posts');
        array_push($posts, ['title' => $title, 'content' => $content ]);
        $session->put('posts',$posts);

    }

    public function editPost($session, $id, $title, $content){
        $posts = $session->get('posts');
        $posts[$id] = ['title' => $title, 'content' => $content];
        $session->put('posts', $posts);

    }

}