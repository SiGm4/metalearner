@extends('main')

@section('title', '| All Posts')

@section('content')
<div class="row">    
    <div class="col-md-8 col-md-offset-2">
        
        @foreach($posts as $post)

            <div class="post">
                <h3>{{ $post->title }}</h3>
                <p>
                    {{ substr(strip_tags($post->body), 0, 300) }}
                    {{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}
                </p>
                <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read more</a>
            </div>
            
            <hr/>
        
        @endforeach
        <div class="text-center"> <!-- pagination -->
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@stop

