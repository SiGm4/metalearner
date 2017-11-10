@extends('main')

@section('title','| Tags')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>All Tags</h1>
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
            @foreach($tags as $tag)
                <tr>
                    <th>{{ $tag->id }}</th>
                    <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                    <td>{{ $tag->posts()->count() }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-default">Edit</a>
                        <form method="POST" action="{{ route('tags.destroy', $tag->id) }}" class="inline-form"> 
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
        <form  method="POST" action="{{ route('tags.store') }}"> 
            <div class="form-group"> 
                <label name="name">Tag:</label> 
                <input id="name" name="name" class="form-control"  required> 
            </div>
            <input type="submit" value="Create Tag" class="btn btn-primary btn-lg btn-block"> 
            {{ csrf_field() }}  
        </form> 
    </div>
</div>
    
@stop