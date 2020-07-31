@extends('layouts.app')

@section('content')
   <div class="container">
      <h1>Create Post</h1>
      {{-- <form method="POST", action="/posts">
         @csrf
         <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
         </div>

         <div class="form-group">
            <button class="btn btn-primary mt-2" type="submit">Create</button>   
         </div>

      </form> --}}
      {!! Form::open(['method'=>'POST', 'action'=>'PostsController@store', 'files'=>true]) !!}

      <div class="form-group">
         {!! Form::label('title', 'Title:') !!}
         {!! Form::text('title', null, ['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
         {!! Form::file('file')!!}
      </div>
   
      <div class="form-group">
         {!! Form::submit('Create Post', ['class'=>'btn btn-primary mt-2']) !!}
      </div>
   
      {!! Form::close() !!}
   
      @if (count($errors) > 0)
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif
   </div>
@endsection
