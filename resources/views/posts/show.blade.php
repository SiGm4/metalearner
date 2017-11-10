@extends('main')

@section('title', '| View Post')

@section('content')
<div class="row">    
    <div class="col-md-8">
        <img src="{{ asset('images/'.$post->image) }}" alt="Post Featured Image" class="featured_image"></img>
        <h1>{{ $post->title }}</h1>
        <h4><a href="/posts/{{ $post->id }}">Change Me: {{ url('/blog')."/".$post->slug }} </a></h4>
        <p class="lead">{!! $post->body !!}</p>
        <hr>
        <div class="tags">
            @foreach($post->tags as $tag)
                <span class="label label-default">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
    <div class="col-md-4 well">
        <dl class="dl-horizontal">
            <dt>Slug</dt>
            <dd>{{ $post->slug }}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Author</dt>
            <dd>{{ $post->author->name }}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Categories</dt>
            @foreach($post->categories as $category)
                <dd>{{ $category->name }}</dd>
            @endforeach
        </dl>
        <dl class="dl-horizontal">
            <dt>Created:</dt>
            <dd>{{ $post->created_at->diffForHumans() }}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Last Updated:</dt>
            <dd>{{ $post->updated_at->diffForHumans() }}</dd>
        </dl>
        <hr>
        
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-block">Edit</a>
            </div>
            <div class="col-sm-6">
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}"> 
                <input type="submit" value="Delete" class="btn btn-danger btn-block"> 
                {{ csrf_field() }}
                {{ method_field('DELETE') }} 
                </form>
            </div>
            <div class="col-sm-12">
                <a href="{{ route('posts.index') }}" class="btn btn-info btn-block btn-h1-spacing">See All Posts</a>
            </div>
        </div>
    </div>
</div>
    
@stop