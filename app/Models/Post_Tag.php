<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Tag extends Model
{
    protected $fillable=['post_id','tag_id','title'];

    public function tag(){
        return $this->belongsTo('tag');
    }
}
