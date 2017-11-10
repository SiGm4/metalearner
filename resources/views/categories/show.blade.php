@extends('main')

@section('title',"| $category->name")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $category->name }} <small>{{ $category->posts()->count() }} Posts</small></h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-block pull-right btn-h1-spacing">Edit</a>
        </div>
        <div class="col-md-2">
            <form method="POST" action="{{ route('categories.destroy', $category->id) }}"> 
                <input type="submit" value="Delete" class="btn btn-danger btn-block pull-right btn-h1-spacing"> 
                {{ csrf_field() }}
                {{ method_field('DELETE') }} 
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Categories</th>
                </tr>
            </thead>
            <tbody>
            @foreach($category->posts()->orderBy('created_at','desc')->get() as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                    <td>
                    @foreach($post->categories as $postCategory)
                        <a href="/categories/{{ $postCategory->id }}"><span class="label label-default">{{ $postCategory->name }}</span></a>
                    @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@stop