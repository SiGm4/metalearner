@extends('main')

@section('title','| Edit Tag')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="{{ route('tags.update', $tag->id) }}">
        <div class="form-group"> 
            <label name="name">Tag:</label> 
            <input id="name" name="name" class="form-control" value="{{ $tag->name }}" required> 
        </div>
        <button type="submit" class="btn btn-success btn-block">Save</button> 
        {{ csrf_field() }}
        {{ method_field("PUT") }}
        </form>
    </div>
</div>

@stop