<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Create a method (Or a function within a class)

    public function index() {
        return 'INDEX';
    }
 
 
 /*
    public function index() {
        return view('pages.index');
    }

    public function about() {
        return view('pages.about');
    }
    
    public function services() {
        return view('pages.services');
    }
 */   
}
