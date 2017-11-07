@extends('main')

@section('title','| Edit Post')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@stop


@section('content')
<div class="row"> 
    <div class="col-md-8 col-md-offset-2"> 
        <h1>Edit Post</h1> 
        <hr> 
        <form method="POST" action="{{ route('posts.update', $post->id) }}"> 
            <div class="form-group"> 
                <label name="title">Title:</label> 
                <input id="title" name="title" class="form-control" maxlength='255' required value="{{ $post->title }}"> 
            </div>
            <div class="form-group"> 
                <label name="slug">Slug:</label> 
                <input id="slug" name="slug" class="form-control" minlength='5' maxlength='255' required value="{{ $post->slug }}"> 
            </div>               
            <div class="form-group"> 
                <label name="body">Post Body:</label> 
                <textarea id="body" name="body" rows="10" class="form-control">{!! $post->body !!}</textarea> 
            </div> 
            <input type="submit" value="Edit Post" class="btn btn-success btn-lg btn-block"> 
            {{ method_field('PUT') }}
            {{ csrf_field() }}  
        </form> 
    </div> 
</div>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script type="text/javascript">
    $(".select2-multi").select2();
</script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
tinymce.init({ 
    selector:'textarea#body', 
    plugins: "link code lists",
    menubar: false
});
</script>
@stop