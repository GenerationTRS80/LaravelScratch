<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  Run construct when the class is instantiated
    public function __construct()
    {
        // Block everything in the dashboard if the user is not authenticated
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // GEt logged in user id
        $user_id=auth()->user()->id;
        $user= User::find($user_id);

        // Pull in the user posts through the relationship created in the model views User and Post
        return view('dashboard')->with('posts',$user->posts);

    }
}
