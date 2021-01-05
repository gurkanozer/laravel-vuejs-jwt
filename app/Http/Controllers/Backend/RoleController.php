<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{

    public function index($id = null)
    {

        if ($id) {
            $result = Role::where('id', $id)->first();
            if ($result) return $result;
            return response()->json([
                'msg' => 'not found'
            ], 403);
        } else
            return Role::get();
    }
    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'permissions' =>'required'
            ]
        );
        return Role::create([
            'title' => $request->title,
            'permissions'=>$request->permissions
        ]);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required|unique:roles'
        ]);

        Role::where('id', $request->id)->update([
            'title' => $request->title
        ]);
        return response()->json(Role::where('id', $request->id)->first());
    }
    public function delete(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required'
            ]
        );
        return Role::where('id', $request->id)->delete();
    }
    public function updatePermissions(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'permissions'=>'required',
            'is_admin' =>'required'
        ]);
        if($request->is_admin){
            return response()->json([
                'msg' => 'error: You cannot change this record'
            ], 403);
        }
        Role::where('id', $request->id)->update([
            'permissions' => $request->permissions
        ]);
        return response()->json(Role::where('id', $request->id)->first());
    }
}
