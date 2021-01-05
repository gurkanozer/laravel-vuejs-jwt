<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPage;

use App\Helpers\Helper;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    public function index($id=null){
        if ($id) {
            $result = StaticPage::where('id', $id)->first();
            if ($result) return $result;
            return response()->json([
                'msg' => 'not found'
            ], 403);
        } else
        return StaticPage::get();
    }

    public function update(Request $request){
        //VALIDATIONS
        $this->validate(
            $request,
            [
                'id' => 'required',
                'title' => 'required',
                'display_name' => 'required',
                'img' => 'image|mimes:jpg,png,jpeg|max:2048'
            ]
        );
        $image = $request->file('img');
        $imgName = "";
        $page = StaticPage::where('id', $request->id)->first();
        if ($image) {
            //IMAGE UPLOADS
            //DELETE 0LD IMAGE
            if (is_file(public_path("/uploads/thumbnail/{$page->img}")) && file_exists(public_path("/uploads/thumbnail/{$page->img}")))
            unlink(public_path("/uploads/thumbnail/{$page->img}"));
            if (is_file(public_path("/uploads/banner/{$page->img}")) && file_exists(public_path("/uploads/banner/{$page->img}")))
                unlink(public_path("/uploads/banner/{$page->img}"));
             //IMAGE UPLOAD SETTINGS
             $slugName = Str::slug($request->title);
             $imgName = time() . '.' . $slugName . '.' . $image->extension();
             $helper = new Helper;
             $helper->resizeImage($image->path(), "banner", $imgName, 950, 532);
             $helper->resizeImage($image->path(), "thumbnail", $imgName,  128, 128);
            }
            $page->display_name = $request->display_name;
            $page->message = $request->message;
            if($request->content)
            $page->content = $request->content;
            else $page->content = "";
            if($image){
                $page->img = $imgName;
            }
            if($page->save()){
                return response()->json(StaticPage::where('id',$request->id)->first(),200);
            }
        
    }
}
