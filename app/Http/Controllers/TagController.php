<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
{

    public function __construct(){
        
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'name' => 'required|min:2|max:255',
        ));
        // store in the database
        $tag = new Tag;

        $tag->name = $request->name;
        $tag->timestamps = false;

        $tag->save();
        // successful message to the user
        Session::flash('success','The tag was successfully saved!');

        // redirect to another page
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('tags.show',['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        
        return view('tags.edit',['tag' => $tag]);
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
        // validate the data
        $this->validate($request, array(
            'name' => 'required|min:2|max:255',
        ));
        // store in the database
        $tag = Tag::find($id);

        $tag->name = $request->name;
        $tag->timestamps = false;

        $tag->save();
        // successful message to the user
        Session::flash('success','The tag was successfully updated!');

        // redirect to another page
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success','The tag was successfully deleted!');
        
        return redirect()->route('tags.index');
    }
}
