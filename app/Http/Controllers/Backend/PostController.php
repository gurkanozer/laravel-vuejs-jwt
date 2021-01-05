<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_Tag;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Error;

class PostController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
            $result = Post::where('id', $id)->with('category:id,title')->with('tag')->first();
            if ($result) {
                return $result;
            } else {
                return response()->json([
                    'msg' => 'not found'
                ], 403);
            }
        }
        return Post::orderBy('id', 'desc')->with('category:id,title')->with('tag')->get();
    }

    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'category_id' => 'required',
                'tags' => 'required',
                'content' => 'required',
                'img' => 'required',
            ]
        );
        $image = $request->file('img');
        $slugName = Str::slug($request->title);
        $input['imagename'] = time() . '.' . $slugName . '.' . $image->extension();
        $helper = new Helper;

        if (
            $helper->resizeImage($image->path(), "banner", $input['imagename'], 950, 532)
            &&  $helper->resizeImage($image->path(), "sneak", $input['imagename'], 750, 300)
            &&  $helper->resizeImage($image->path(), "thumbnail", $input['imagename'], 128, 128)
        ) {
            DB::beginTransaction();
            try {
                $post = Post::create([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'content' => $request->content,
                    'user_id' => auth()->user()->id,
                    'img' => $input['imagename']
                ]);
                $tags = json_decode($request->tags);
                $post_tags = [];
                foreach ($tags as $t) {
                    array_push($post_tags, ['post_id' => $post->id, 'tag_id' => $t->id, 'title' => $t->title, 'created_at' => date("Y-m-d h:i:s")]);
                }
                Post_Tag::insert($post_tags);
                DB::commit();
                return response()->json(Post::where('id', $post->id)->with('category:id,title')->with('tag')->first(), 201);
            } catch (Error $err) {
                DB::rollback();
                return response()->json([
                    'error' => $err
                ], 403);
            }
        }
    }

    public function update(Request $request)
    {
        //VALIDATIONS
        $this->validate(
            $request,
            [
                'id' => 'required',
                'title' => 'required',
                'category_id' => 'required',
                'tags' => 'required',
                'content' => 'required',
                'img' => 'image|mimes:jpg,png,jpeg|max:2048'
                // |dimensions:min_width=100,min_height=200
            ]
        );
        $image = $request->file('img');
        $imgName = "";
        if ($image) {
            //IMAGE UPLOADS
            $post = Post::where('id', $request->id)->first();
            //DELETE 0LD IMAGE
            if (is_file(public_path("/uploads/thumbnail/{$post->img}")) && file_exists(public_path("/uploads/thumbnail/{$post->img}")))
                unlink(public_path("/uploads/thumbnail/{$post->img}"));
            if (is_file(public_path("/uploads/banner/{$post->img}")) && file_exists(public_path("/uploads/banner/{$post->img}")))
                unlink(public_path("/uploads/banner/{$post->img}"));
            if (is_file(public_path("/uploads/sneak/{$post->img}")) && file_exists(public_path("/uploads/sneak/{$post->img}")))
                unlink(public_path("/uploads/sneak/{$post->img}"));
            //IMAGE UPLOAD SETTINGS
            $slugName = Str::slug($request->title);
            $imgName = time() . '.' . $slugName . '.' . $image->extension();
            $helper = new Helper;
            $helper->resizeImage($image->path(), "banner", $imgName, 950, 532);
            $helper->resizeImage($image->path(), "sneak", $imgName, 750, 300);
            $helper->resizeImage($image->path(), "thumbnail", $imgName, 128, 128);
            // if (
            //     !&&
            //     ! &&
            //     !
            // ) {
            //     return response()->json([
            //         ['error' => 'something went wrong']
            //     ], 403);
            //     die();
            // }
        }
        DB::beginTransaction();
        try {
            $post = Post::find($request->id);
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->content = $request->content;
            if ($image)
                $post->img = $imgName;
            $post->updated_at = date("Y-m-d h:i:s");
            $post->save();

            $tags = json_decode($request->tags);
            $post_tags = [];
            Post_Tag::where('post_id', $request->id)->delete();
            foreach ($tags as $t) {
                array_push($post_tags, ['post_id' => $request->id, 'tag_id' => $t->id, 'title' => $t->title, 'updated_at' => date("Y-m-d h:i:s")]);
            }
            Post_Tag::insert($post_tags);
            DB::commit();
            return response()->json(Post::where('id', $request->id)->with('category:id,title')->with('tag')->first(), 200);
        } catch (Error $err) {
            DB::rollback();
            return response()->json([
                ['error' => $err]
            ], 403);
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $post = Post::where('id', $request->id)->first();
        if (is_file(public_path("/uploads/thumbnail/{$post->img}")) && file_exists(public_path("/uploads/thumbnail/{$post->img}")))
            unlink(public_path("/uploads/thumbnail/{$post->img}"));

        if (is_file(public_path("/uploads/banner/{$post->img}")) && file_exists(public_path("/uploads/banner/{$post->img}")))
            unlink(public_path("/uploads/banner/{$post->img}"));

        if (is_file(public_path("/uploads/sneak/{$post->img}")) && file_exists(public_path("/uploads/sneak/{$post->img}")))
            unlink(public_path("/uploads/sneak/{$post->img}"));
        return $post->delete();
    }
}
