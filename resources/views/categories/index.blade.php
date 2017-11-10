@extends('main')

@section('title','| Categories')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>All Categories</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th>{{ $category->id }}</th>
                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->posts()->count() }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="inline-form"> 
                            <input type="submit" value="Delete" class="btn btn-danger"> 
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }} 
                        </form>
                    </td>
                </tr>
            @endforeach            
            </tbody>
        </table>
    </div>
    <div class="col-md-3 col-md-offset-1 btn-h1-spacing">
        <form  method="POST" action="{{ route('categories.store') }}"> 
            <div class="form-group"> 
                <label name="name">Category:</label> 
                <input id="name" name="name" class="form-control"  required> 
            </div>
            <input type="submit" value="Create Category" class="btn btn-primary btn-lg btn-block"> 
            {{ csrf_field() }}  
        </form> 
    </div>
</div>
    
@stop