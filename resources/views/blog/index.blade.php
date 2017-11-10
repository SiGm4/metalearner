@extends('main')

@section('title', '| All Posts')

@section('header')
    @include('partials._header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2 text-center">
        
    </div>
</div>
<div class="row">    
    <div class="col-md-8 col-md-offset-2">
        
        @foreach($posts as $post)

            <div class="post">
                <a href="{{ route('blog.single', $post->slug) }}">
                    <img src="{{ asset('images/'.$post->image) }}" alt="Post Featured Image" class="featured_image"></img>
                </a>
                <h3><a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a></h3>
                <p>
                    {{ substr(strip_tags($post->body), 0, 300) }}
                    {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}
                </p>
                <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-readmore">Read more</a>
            </div>
            
            <hr/>
        
        @endforeach
        <div class="text-center"> <!-- pagination -->
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@stop


