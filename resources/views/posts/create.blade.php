@extends('layouts.app')

{{-- Use Laravel Collective https://laravelcollective.com/docs/5.4/html to use as a HTML form Helper--}}
@section('content')
  <h1>Create Post</h1>

  
  {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
    <div class="form-group">
      {{-- Title --}}
      {{Form::label('title','Title')}}

      {{-- Input --}}
      {{-- Text object arguments (Name, value,class,place holder )  --}}
      {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{-- Text area object arguments (Name, value,class,place holder )  --}}        
        {{Form::textarea('body','',['class' => 'form-control','placeholder' => 'Body Text'])}}
    </div>
    {{-- Add submit button --}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
  {!! Form::close() !!}


@endsection