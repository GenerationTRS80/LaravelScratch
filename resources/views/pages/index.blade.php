@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
    <h1> {{$title}}</h1>
    <p> This is the laravel application from the "Laravel from Scratch" Youtube series</p>
    <p><a class="brt btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
@endsection