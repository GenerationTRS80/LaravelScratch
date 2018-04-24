@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default">Go Back</a>
  <h1>{{$post->title}}</h1>
    <div>
      {{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>

    {{-- @if(count($posts)>1)
      @foreach($posts as $post)
          <div class="well">
            <h3><a href="/posts/{{$post->posts_key}}">{{$post->title}}</a></h3>
            <small>Written on {{$post->created_at}}</small>
          </div>
      @endforeach
    @else
      <p>No posts found</p>
    @endif --}}
@endsection