@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
            @foreach ($posts as $post)
                <div>
                <img height="50" src="{{$post->path}}"> 
                </div>
                <li><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
