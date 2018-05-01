@extends('layouts.app')

{{-- Use Laravel Collective https://laravelcollective.com/docs/5.4/html to use as a HTML form Helper--}}
@section('content')
  <h1>Edit Post</h1>

  {{-- NOTE: For www.mono-print.com You need to have 'PostsController' plural --}}
  {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST']) !!}
    <div class="form-group">
      {{-- Title --}}
      {{Form::label('title','Title')}}

      {{-- Input --}}
      {{-- Text object arguments (Name, value,class,place holder )  --}}
      {{Form::text('title',$post->title,['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{-- Text area object arguments (Name, value,class,place holder )  --}}        
        {{Form::textarea('body',$post->body,['id' => 'article-ckeditor', 'class' => 'form-control','placeholder' => 'Body Text'])}}
    </div>
    {{-- Spoof a PUT request --}}
    {{Form::hidden('_method','_PUT')}}



    {{-- Add submit button When submitted there will be a post request to store method in the PostsController --}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}


@endsection