<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author(){
        
        return $this->belongsTo('App\User','user_id','id');
        
    }

    public function categories(){
        
        return $this->belongsToMany('App\Category','post_category','post_id','category_id');
        
    }

    public function tags(){
        
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
        
    }

 
}
