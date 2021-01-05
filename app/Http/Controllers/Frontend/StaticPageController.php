<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPage;
use App\Models\Category;
use App\Models\Setting;

class StaticPageController extends Controller
{
    public function index($page){
        $context = [];
        $context['page'] = StaticPage::where('title',$page)->first();
        $context['settings'] = Setting::first();
        
        $context['categories'] = Category::get();
        // dd($context['page']);die();
        return view("pages.$page",$context);
    }
}
