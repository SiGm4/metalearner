@extends('main')

@section('title', '| All Posts')

@section('header')
    @include('partials._header')
@stop

@section('content')
<div class="row">    
    <div class="col-md-8 col-md-offset-2">
        <h1 class="blog-title blog-title-line">Latest Posts</h1>
        @foreach($posts as $post)

            <div class="post">
                <div class="featured_image_div">
                    <a href="{{ route('blog.single', $post->slug) }}">
                        <img src="{{ asset('images/'.$post->image) }}" alt="Post Featured Image" class="featured_image featured_image_outer"></img>
                    </a>
                </div>
                <div class="abstract_div">
                    <h3><a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a></h3>
                    <p>
                        {{ substr(strip_tags($post->body), 0, 300) }}
                        {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}
                    </p>
                </div>
            </div>
        
        @endforeach
        <div class="text-center"> <!-- pagination -->
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@stop


