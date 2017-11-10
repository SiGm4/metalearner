@extends('main')

@section('title', '| '.htmlspecialchars($post->title))

@section('content')
<div class="row">    
    <div class="col-md-8 col-md-offset-2">
        <img src="{{ asset('images/'.$post->image) }}" alt="Post Featured Image" class="featured_image"></img>
        <h1>{{ $post->title }}</h1>
        <h6>{{ date('j M, Y H:i',strtotime($post->created_at)) }} by Dimitris Gkiokas</h6>
        <p class="lead">{!! $post->body !!}</p>
        <hr>
        <p>Posted In: {{ $post->categoryNames() }}</p>
        <hr>
    </div>
</div>
@stop


