<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

// Use DB library to write SQL statements
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Elequent (an object relational mapper) allows you to use any Model function
        // Fetch all the data in the model (table) Rpost is a recordset
        // return Post::all(); 
        // $posts = Post::all();

        // # Add clause to sort posts by title
        // $posts = Post::orderBy('title','desc')->get();

        // # Where clause
        # $posts = Post::orderBy('title','desc')->take(1)->get();
        # return Post::where('title','Post Two')->get();

        // Paginate
        # NOTE: If you set paginate to paginate(10) then pagination will not show unless more that 10 posts
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        // Read data to the view ie copyrecordset
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // This is where the submit button makes its request
        // Validate the title and body from the create post form 
        $this->validate($request,
        [
            'title'=> 'required',
            'body'=> 'required'
        ]);

        // Create Post (Post is brought in from Use App\Post)
        $post = new Post;
        $post->title = $request->input('title');
        $post->body= $request->input('body');     

        // Save the post to the DB
        $post->save();

        // Redirect after posting to the message.blade.php file
        return redirect('/posts')->with('success','Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Post::find($id);
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
