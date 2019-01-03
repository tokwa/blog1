<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PagesController extends Controller
{
    public function index() {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        // or $posts = Post::orderBy('created_at', 'desc')->get();
        return view('pages.index')->with('x', $posts);
    }

    public function about() {
        return 'about';
    }
}
