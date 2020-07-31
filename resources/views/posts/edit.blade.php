@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit post</h1>
        {!! Form::open(['method'=>'PATCH', 'action'=>['PostsController@update', $post->id]]) !!}
    
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
            {!! Form::submit('Update Post', ['class'=>'btn btn-info mt-2']) !!}
    
        {!! Form::close() !!}
    
        {!! Form::open(['method'=>'DELETE', 'action'=>['PostsController@destroy', $post->id]]) !!}
    
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger mt-2']) !!}
    
        {!! Form::close() !!}
    </div>
@endsection
