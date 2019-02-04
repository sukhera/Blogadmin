@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">The beautiful Laravel</p>
        </div>
    </div>
    @foreach($posts as $post)
    <div class="row">

        <div class="col-md-12 text-center">
            <h1 class="post-title">{{ $post->title }}</h1>
            @foreach($post->tags as $tags)
            --- {{ $tags->name }} ---
            @endforeach
            <p>{{ $post->content }}</p>

            <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">Read more...</a></p>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            {{ $posts->links() }}
        </div>
    </div>

@endsection