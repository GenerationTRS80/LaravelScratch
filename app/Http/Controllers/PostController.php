<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

// Use DB library to write SQL statements
use DB;

class PostController extends Controller
{
    /**
     * Add a new controller instance.
     *
     * @return void
     */

    //  Run construct when the class is instantiated
    public function __construct()
    {
        // Block everything in the dashboard if the user is not authenticated
        // Add except to add an array of views that needs an except for
        $this->middleware('auth',['except'=> ['index','show']]);
    }
    
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
            'body'=> 'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            //  Submit image - Get file name with extenstion
            $fileNameWithExt = $request->file('cover_image')->GetClientOriginalImage();

            // Get just file name - pathinfo gets PHP
            // Note: need to use pathinfo because there isn't anything in Laravel to get file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File name to store
            // Note: Need to prevent duplicate file names from uploading by comparing names
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // Upload image
            // Note: create folder public/cover_images if it has not already been created
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post (Post is brought in from Use App\Post)
        $post = new Post;
        $post->title = $request->input('title');
        $post->body= $request->input('body'); 
        
        // Use auth() for authentication
        $post->user_id= auth()->user()->id;

        // Post image to DB
        $post->cover_image = $fileNameToStore;

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
        $post = Post::find($id);

        // Check for correct user. If NOT authorized user then prevent them form editing the post
        if(auth()->user()->id !==$post->user_id){

            // Show page if not authorized
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
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

        // Update Post
        $this->validate($request,
        [
            'title'=> 'required',
            'body'=> 'required'
        ]);

        // Update Post (use find to update the correct record)
        // $post = new Post;
        $post = Post::find($id);       
        $post->title = $request->input('title');
        $post->body= $request->input('body');     

        // Save the post to the DB
        $post->save();

        // Redirect after posting to the message.blade.php file
        return redirect('/posts')->with('success','Post Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);        


        // Check for correct user. If NOT authorized user then prevent them from deleting the post
        if(auth()->user()->id !==$post->user_id){

            // Show page if not authorized
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        $post->delete();
        return redirect('/posts')->with('remove','Post Removed');
    }
}
