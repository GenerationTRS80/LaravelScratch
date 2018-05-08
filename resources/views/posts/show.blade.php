@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default">Go Back</a>
  <h1>{{$post->title}}</h1>
    <div>
      {{-- Parse HTML with double exclamation !! --}}
      {{-- When using the CheckEditor in the Create Post body, it will use HTML tags in the formatting of the text --}}
      {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    {{-- Note: You need to use posts_key and NOT id --}}
    <a href="/posts/{{$post->posts_key}}/edit" class="btn btn-default">Edit</a>

    {!! Form::open(['action' => ['PostController@destroy',$post->posts_key],'method'=>'POST', 'class'=>'pull-right']) !!}

      {{-- Spoof a DELETE request Note: HTML Doesn't support PUT or DELETE methods, then need to be hidden--}}
      {{ Form::hidden('_method','DELETE')}}
      {{ Form::submit('Delete', ['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}
 
@endsection