<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use Session;

class PostController extends Controller
{
    // Setting this Controller up for back-end
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(array(
            'title' => 'required|min:5|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required',
            'user_id' => 'required|integer',
        ));
        
        $post = new Post;
        $author = User::find($request->user_id);

        $post->title = $request->title;
        $post->slug  = $request->slug;
        $post->body  = $request->body;

        $post->author()->associate($author);

        $post->save();
        
        Session::flash('success', "Blog Post was created successfully.");
        
        return redirect()->route('posts.show', $post->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $post  = Post::find($id);
        return view('posts.edit', ['users' => $users, 'post' => $post]);
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
        $request->validate(array(
            'title' => 'required|min:5|max:255',
            'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'body' => 'required'
        ));
        
        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug  = $request->slug;
        $post->body  = $request->body;

        $post->save();
        
        Session::flash('success', "Blog Post was edited successfully.");
        
        return redirect()->route('posts.show', $post->id);
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

        $post->delete();

        Session::flash('success','The blog post was successfully deleted!');
        
        return redirect()->route('posts.index');
    }
}
