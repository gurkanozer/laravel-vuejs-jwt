<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable=['title','slug','status'];

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
