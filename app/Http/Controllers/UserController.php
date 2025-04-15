<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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

        if($data['is_admin'] == 1 ){
            return redirect('MenuForAdmin');
        }else{
            return redirect('MenuForStaff');
        }
    }


    // add user 


    // show user data 
    public function showData($id){
        $data = User::find($id);

    if (!$data) {
        return abort(404, "User not found");
    }

    return view("ProfilePage", [
        'data' => $data,
    ]);
    }
}
