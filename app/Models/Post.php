<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable=['user_id','category_id','title','slug','img','content','status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tag(){
        return $this->hasMany(Post_Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title']= $value;
        $this->attributes['slug']= $this->makeSlugUnique($value);
    }

    private function makeSlugUnique($title){
        $slug = Str::slug($title,'-');
        $count = Category::where('title','LIKE',"{$slug}%")->count();
        if($count > 0){
            return $slug."-".++$count;
        }
        else{
            return $slug;
        }
    }
}
