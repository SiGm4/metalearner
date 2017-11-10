@extends('main')

@section('title', '| Posts Index')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Posts</h1>
        </div>
        <div class="col-md-2">
            <a class="btn btn-lg btn-block btn-primary btn-h1-spacing" href="{{ route('posts.create') }}">Create New Post</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Body</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Created</th>
                    <th>Actions</th>
                </thead>

                <tbody>
                    
                    @foreach($posts as $post)

                        <tr>
                            <th>{{ $post->id }}</th>
                            <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                {{ substr(strip_tags($post->body), 0, 50) }}
                                {{ strlen(strip_tags($post->body)) > 50 ? "..." : "" }}
                            </td>
                            <td>{{ $post->author->name }}</td>
                            <td>
                                {{ join('/',$post->categoryNames()->all()) }}                                 
                            </td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-block">Edit</a>                             
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

            <div class="text-center"> <!-- pagination -->
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@stop
