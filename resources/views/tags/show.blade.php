@extends('main')

@section('title',"| $tag->name")

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $tag->name }} <small>{{ $tag->posts()->count() }} Posts</small></h1>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block pull-right btn-h1-spacing">Edit</a>
        </div>
        <div class="col-md-2">
            <form method="POST" action="{{ route('tags.destroy', $tag->id) }}"> 
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
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tag->posts()->orderBy('created_at','desc')->get() as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                    <td>
                    @foreach($post->tags as $postTag)
                        <a href="/tags/{{ $postTag->id }}"><span class="label label-default">{{ $postTag->name }}</span></a>
                    @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@stop