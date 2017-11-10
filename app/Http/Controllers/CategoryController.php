<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
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
        $categories=Category::all();
        return view('categories.index', ['categories' => $categories]);
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
        $category = new Category;

        $category->name = $request->name;
        $category->timestamps = false;

        $category->save();
        // successful message to the user
        Session::flash('success','The category was successfully saved!');

        // redirect to another page
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('categories.show',['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        
        return view('categories.edit',['category' => $category]);
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
        $category = Category::find($id);

        $category->name = $request->name;
        $category->timestamps = false;

        $category->save();
        // successful message to the user
        Session::flash('success','The category was successfully updated!');

        // redirect to another page
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        $category->posts()->detach();

        $category->delete();

        Session::flash('success','The category was successfully deleted!');
        
        return redirect()->route('categories.index');
    }
}
