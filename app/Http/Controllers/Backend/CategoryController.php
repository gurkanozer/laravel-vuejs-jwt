<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($id=null){

        if($id){
            $result = Category::where('id',$id)->first();
            if($result) return $result;
            return response()->json([
                'msg' => 'not found'
            ], 403);
        }
        else
            return Category::get();
    }
    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => "required|unique:categories,title"
            ]
        );
        return Category::create([
            'title' => $request->title,
        ]);        
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'id' =>'required',
            'title' => "required|unique:categories,title,$request->id"
        ]);
        $category = Category::find($request->id);
        $category->title = $request->title;
        $category->save();
        return response()->json(Category::where('id',$request->id)->first());
    }
    public function delete(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required'
            ]
        );
        return Category::where('id',$request->id)->delete();
    }
}
