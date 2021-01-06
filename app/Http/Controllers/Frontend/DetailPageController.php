<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;

class DetailPageController extends Controller
{
    public function index($category_slug,$title_slug){
        $context=[];
        $context['categories'] = Category::get();
        $context['settings'] = Setting::first();
        $context['item'] = Post::with('tag:id,post_id,tag_id,title')->with('user:id,full_name,img')->with('category:id,title,slug')->where('slug',$title_slug)->first(['id','title','slug','img','content','category_id','user_id','updated_at']);
        $context['page'] = (object)['img'=> $context['item']->img,'message'=>$context['item']->title];
        return view('pages.detail',$context);
    }
}
