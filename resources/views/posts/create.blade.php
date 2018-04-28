@extends('layouts.app')

{{-- Use Laravel Collective https://laravelcollective.com/docs/5.4/html to use as a HTML form Helper--}}
@section('content')
  <h1>Create Post</h1>

  
  {!! Form::open(['action' => 'PostController@store', 'method' => 'POST']) !!}
    <div class="form-group">
      {{-- Title --}}
      {{Form::label('title','Title')}}

      {{-- Input --}}
      {{-- Text object Arguments (Name, value,class,place holder )  --}}
      {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}


    </div>
  {!! Form::close() !!}


@endsection