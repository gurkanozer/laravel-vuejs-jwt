<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index($id = null)
    {
        if ($id) {
            $result = User::where('id', $id)->with('role')->first();
            if ($result) return $result;
            else return response()->json([
                'msg' => 'not found'
            ], 403);
        }
        return User::orderBy('id', 'desc')->with('role')->get();
    }

    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'full_name' => 'required',
                'email' => 'required|email|unique:users',
                'role_id' => 'required',
                'img' => 'required'
            ]
        );

        $image = $request->file('img');
        $slugName = Str::slug($request->full_name);
        $imgName = time() . $slugName . '.' . $image->extension();
        $helper = new Helper;

        if ($helper->resizeImage($image->path(), "thumbnail", $imgName, 128, 128)) {
            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'img' => $imgName,
                // 'password' => Hash::make(Str::random(8)),
                'password' => Hash::make('password')
            ]);
            return response()->json(User::where('id', $user->id)->with('role')->first(), 201);
        }
        return response()->json(['msg' => 'Something went wrong', 403]);
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required',
                'full_name' => 'required',
                'email' => "required|email|unique:users,email,$request->id",
                'img' => 'image|mimes:jpg,png,jpeg|max:2048',
                'role_id'=>'required'
            ]
        );
        $imgName = "";
        $image = $request->file('img');
        $user = User::where('id', $request->id)->first();
        if ($image) {
            //IMAGE UPLOADS
            //DELETE 0LD IMAGE
            if (file_exists(public_path("/uploads/thumbnail/{$user->img}")) && file_exists(public_path("/uploads/thumbnail/{$user->img}")))
                unlink(public_path("/uploads/thumbnail/{$user->img}"));
            //IMAGE UPLOAD SETTINGS
            $slugName = Str::slug($user->full_name);
            $imgName = time() . $slugName . '.' . $image->extension();
            $helper = new Helper;
            //if image uploaded continue
            if (!$helper->resizeImage($image->path(),"thumbnail", $imgName, 128, 128)) {
                return response()->json([
                    ['error' => 'something went wrong']
                ], 403);
                die();
            }
        }
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        if($request->id)
            $user->role_id = $request->role_id;
        if ($image)
            $user->img = $imgName;
        if ($user->save())
            return response()->json(User::where('id', $request->id)->with('role')->first(), 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        if (file_exists(public_path("/uploads/thumbnail/{$user->img}")))
            unlink(public_path("/uploads/thumbnail/{$user->img}"));
        return $user->delete();
    }

    public function changePassword(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]
        );
        User::where('id', $request->id)->update([
            'password' => Hash::make('password')
        ]);
        return response()->json(User::where('id', $request->id)->with('role')->first(), 200);
    }
}
