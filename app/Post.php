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

    public function categoryIds(){
        
        return $this->categories->pluck('id');
        
    }

    public function categoryNames(){
        
        return $this->categories->pluck('name');
        
    }

    public function categoriesWithLinks(){
        
        $categLinks = [];
        foreach($this->categories as $category){
            $categLinks[] = "<a href='/categories/$category->id'>$category->name</a>";
        }
        return $categLinks;
        
    }

    public function tags(){
        
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
        
    }

    public function tagsIds(){
        
        return $this->tags->pluck('id');
        
    }

 
}
