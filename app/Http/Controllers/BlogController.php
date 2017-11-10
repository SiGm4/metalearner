<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{

    public function getindex(){
        $posts = Post::orderBy('id', 'desc')->paginate(3);

        return view('blog.index' , ['posts' => $posts]);
    }

    public function getSingle($slug){
        // fetch from db based on slug
        $post = Post::where('slug', '=', $slug)->first();

        if (is_null($post)){
            abort(404);
        }
        
        // return the view and pass in the post object
        return view('blog.single', [ 'post' => $post]);
    }
    
}
