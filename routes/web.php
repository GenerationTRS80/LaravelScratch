<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
Route::get('/', function () {
    // return 'Hello World';
    // Parse HTML
    return '<h1>Hello World</h1>';
});

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'This is user '.$name. ' with an id of '.$id;
});

 */

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

// Create all the routes that are required with PostController
// Note: it should be 'posts' (plural)  NOT  'post' (singular)
Route::resource('posts','PostController');

// # Add May 1 2018 PS
// Route::put('posts', 'PostController@update');

/*
Route::get('/about', function () {
    return view('pages.about');
});
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
