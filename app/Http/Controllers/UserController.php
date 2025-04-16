<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Cookies;

class UserController extends Controller
{
    // login part
    function login(Request $request){
        $request->validate(
            [
            'username' => 'required | max:5',
            'password' => 'required | min:11'
            ]
        );

        $data = $request -> input();
        $request-> session()->put('user', $data['username']);
        //get cookie to get the username
        request()->cookie('username');

        if($data['is_admin'] == 1 ){
            return $data->role = 'admin';
        }else{
            return $data->role = 'staff';
        }
    }


    // add user (admin privilege only)
    public function AddUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', 'User added successfully!');
    }

    // show user data 
    public function showData($id){
        $data = User::find($id);

    if (!$data) {
        return abort(404, "User not found");
    }

    // Get the previous and next users
    $prevUser = User::where('id', '<', $id)->orderBy('id', 'desc')->first();
    $nextUser = User::where('id', '>', $id)->orderBy('id', 'asc')->first();

    return view("ProfilePage", [
        'data' => $data,
        'prevUser' => $prevUser,
        'nextUser' => $nextUser
    ]);
    }
}
