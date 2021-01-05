<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagController extends Controller
{
    public function index($id = null)
    {

        if ($id) {
            $result = Tag::where('id', $id)->first();
            if ($result) return $result;
            return response()->json([
                'msg' => 'not found'
            ], 403);
        } else
            return Tag::get();
    }
    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required'
            ]
        );
        $slug = Str::slug($request->title);
        return Tag::create([
            'title' => $slug
        ]);
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'id' =>'required',
            'title' => 'required|unique:roles'
        ]);

        Tag::where('id',$request->id)->update([
            'title'  => Str::slug($request->title)
        ]);
        return response()->json(Tag::where('id',$request->id)->first());
    }
    public function delete(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required'
            ]
        );
        return Tag::where('id',$request->id)->delete();
    }
}
