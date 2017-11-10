<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Session;
use Image;
use Storage;

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
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', [
            'users' => $users,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $request->validate(array(
            'title' => 'required|min:5|max:255',
            'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required',
            'user_id' => 'required|integer',
            'featured_image' => 'sometimes|image'
        ));
        
        $post = new Post;
        $author = User::find($request->user_id);

        $post->title = $request->title;
        $post->slug  = $request->slug;
        $post->body  = $request->body;

        $post->author()->associate($author);

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);

            $post->image = $filename;
        }

        $post->save();
        
        $post->categories()->sync($request->categories, false);
        $post->tags()->sync($request->tags, false);
        
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', [
            'users' => $users,
            'tags' => $tags,
            'categories' => $categories,
            'post' => $post
        ]);
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
            'body' => 'required',
            'featured_image' => 'image'
        ));
        
        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug  = $request->slug;
        $post->body  = $request->body;
        
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);
            
            $oldFilename = $post->image;

            $post->image = $filename;

            Storage::delete($oldFilename);
        }

        $post->save();

        if (isset($request->categories)){
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->sync(array());
        }

        if (isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }
        
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

        $post->categories()->detach();
        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success','The blog post was successfully deleted!');
        
        return redirect()->route('posts.index');
    }
}
