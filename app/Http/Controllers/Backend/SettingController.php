<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\Helper;
use Hamcrest\Core\Set;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function index()
    {
        return Setting::first();
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'blog_name' => "required",
                'blog_logo' =>  "image|mimes:png,jpg,jpeg",
                'contact_email' => "required|email",
            ]
        );
        $imgName = "";
        $image = $request->file('blog_logo');
        $settings = Setting::first();
        if ($image) {
            //IMAGE UPLOADS
            //DELETE OLD IMAGE
            if (is_file(public_path("/uploads/thumbnail/{$settings->blog_logo}")) && file_exists(public_path("/uploads/thumbnail/{$settings->blog_logo}")))
                unlink(public_path("/uploads/thumbnail/{$settings->blog_logo}"));
            $slugName = Str::slug($request->title);
            $imgName = time() . '.' . $slugName . '.' . $image->extension();
            $thumbPath = public_path('/uploads/thumbnail');
            $helper = new Helper;

            if(!$helper->resizeImage($image->path(), $thumbPath, $imgName, 128, 128)){
                return response()->json([
                    ['error' =>'something went wrong']
                ], 403);
                die();
            }
        }
            $settings->blog_name = $request->blog_name;
            $settings->contact_email = $request->contact_email;
            if($image)
                $settings->blog_logo = $imgName;
            $settings->updated_at =  date("Y-m-d h:i:s");
            if($settings->save()){
                return response()->json(
                    Setting::first()
                ,200);
            }
            

    }
}
