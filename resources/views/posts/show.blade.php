@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><a href="{{route('posts.edit', $post->id)}}">{{ $post->title }}</a></h1>

    </div>
@endsection
