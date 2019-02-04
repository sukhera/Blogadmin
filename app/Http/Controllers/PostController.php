<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\Tag;
use Auth;
use Gate;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //
    public function getIndex(){
        $posts = Post::orderBy('created_at','desc')->paginate(2);
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex(){
        $tags = Tag::all();
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts, 'tags' => $tags]);
    }

    public function getAdminCreate(){
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getPost($id){
        $post = Post::find($id);
        return view('blog.post', ['post' => $post]);
    }

    public function getLikesPost($id){
        $post = Post::find($id);
        $like = new Like();
        $post->likes()->save($like);

        return redirect()->back();


    }

    public function getAdminEdit($id){
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags])  ;

    }

    public function getAdminDelete($id){

        $post = Post::find($id);

        if (Gate::denies('manipulate-post', $post)){

            return redirect()->back();
        }
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info', 'Post has been Deleted');

    }

    public function postAdminCreate(Request $request){
        $this->validate($request,[
                'title' => 'required|min:5',
                'content' => 'required|min:10'
            ]
        );
        $user = Auth::user();


        $post = new Post([
            'title'     => $request->input('title'),
            'content'   => $request->input('content')
        ]);
        $user->posts()->save($post);
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

        return redirect()->route('admin.index')->with('info', 'Post has been created with the title' .$request->input('title'));
    }

    public function postAdminUpdate(Request $request){

        $this->validate($request,[
                'title' => 'required|min:5',
                'content' => 'required|min:10'
            ]
        );
        $postToDeleteId = $request->input('postID');
        $post = Post::find($postToDeleteId);

        if (Gate::denies('manipulate-post', $post)){
            return redirect()->back();
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        return redirect()->route('admin.index')->with('info','Post with the title: '. $post->title. ' has been edited.');

    }




}
