<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\StaticPage;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index(){
        $context = [];
        $context['page'] = StaticPage::where('title','home')->first();
        $context['settings'] = Setting::first();
        $context['posts'] = Post::with('user:id,full_name,img')->with('category:id,title,slug')->get(['id','title','content','user_id','category_id','img','slug','updated_at']);

        $context['categories'] = Category::get();
        // dd($context['settings']);die();
        return view('pages.home',$context);
    }
}
