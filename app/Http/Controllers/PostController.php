<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(5);
        return view('posts.index')->with('x', $posts);
         // return view('posts.index', compact('posts'));
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
        $request->validate([
            'title'=>['required', 'string'],
            'body'=>['required'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = htmlentities($request->input('body'));
        $post->user_id = Auth::user()->id;
        // $table->unsignedInteger('user_id')->default(10)->change();
        if ($request->hasFile('image')) {
            $imgName = date('Y-m-d'). "_" . 
            $request->file('image')->getClientOriginalName();
            $post->image = $imgName;
        }
       
        if ($post->save()) {
            $request->image->move(public_path('images'), $imgName);
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $post = Post::where('user_id', Auth::user()->id)->findOrFail($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'title' => ['required'],
            'body' => ['required']
        ]);

        $post = Post::where('user_id', Auth::user()->id)->findOrFail($id);
        $post->title = $request->input('title');
        $post->body = htmlentities($request->input('body'));
        $post->save();
        
        return redirect('/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('user_id', Auth::user()->id)->findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }
}
