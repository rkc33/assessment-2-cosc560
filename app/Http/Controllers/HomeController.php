<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   // HomeController.php
 // Show dashboard with posts
    public function index()
    {
        // Fetch posts with category relationship
        $posts = Post::with('category')->latest()->get();

        // Pass to home.blade.php
        return view('home', compact('posts'));
    }

}
