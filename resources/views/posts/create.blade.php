@extends('main')

@section('title','| Create New Post')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@stop


@section('content')
<div class="row"> 
    <div class="col-md-8 col-md-offset-2"> 
        <h1>Create New Post</h1> 
        <hr> 
        <form method="POST" action="{{ route('posts.store') }}"> 
            <div class="form-group"> 
                <label name="title">Title:</label> 
                <input id="title" name="title" class="form-control" maxlength='255' required> 
            </div>
            <div class="form-group"> 
                <label name="slug">Slug:</label> 
                <input id="slug" name="slug" class="form-control" minlength='5' maxlength='255' required> 
            </div>
            <div class="form-group"> 
                <label name="user_id">Author:</label> 
                <select id="user_id" name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check"> 
                <label name="categories">Categories:</label>    
                <div class="row">
                    @foreach($categories as $category)   
                        <div class="col-md-4">
                            <label class="form-check-label">
                                <input class="form-check-input" name="categories[]" type="checkbox" value="{{ $category->id }}">
                                {{ $category->name }}                       
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>    
            <div class="form-group"> 
                <label name="tags">Tags:</label> 
                <select id="tags" name="tags[]" class="form-control select2-multi" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>    
               
            <div class="form-group"> 
                <label name="body">Post Body:</label> 
                <textarea id="body" name="body" rows="10" class="form-control"></textarea> 
            </div> 
            <input type="submit" value="Create Post" class="btn btn-success btn-lg btn-block"> 
            {{ csrf_field() }}  
        </form> 
    </div> 
</div>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2-multi').select2();
});
</script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
tinymce.init({ 
    selector:'textarea#body', 
    plugins: "link code lists",
    menubar: false
});

// Temporary notification fix
setTimeout(function(){ 
    $(".mce-notification-warning").hide(); 
    $(".mce-branding-powered-by").hide(); 
},1000)
</script>
@stop