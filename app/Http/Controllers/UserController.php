<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Cookies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
>>>>>>> JH_20250419_1

class UserController extends Controller
{
    // login part
    public function login(Request $request){
        $request->validate(
            [
            'username' => 'required | min:4',
            'password' => 'required | min:8'
            ]
        );

<<<<<<< HEAD
        $data = $request -> input();
        $request-> session()->put('user', $data['username']);

        if($data['is_admin'] == 1 ){
            return redirect('MenuForAdmin');
        }else{
            return redirect('MenuForStaff');
=======
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $user = User::where('name', $request->username)->first();
            $request->session()->put('name', $user->name);
            $request->session()->put('user_id', $user->id);
            // Login successful, redirect to menu
            return redirect()->intended('/Menu');
        } else {
            // Login failed, redirect back with error message
            return back()->withInput($request->only('username'))->withErrors(['password' => 'Invalid credentials']);
>>>>>>> JH_20250419_1
        }
    }

    // index 
    public function index(Request $request){
        $query = User::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%")
                  ->orWhere('position', 'LIKE', "%{$search}%")
                  ->orWhere('department', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
        }
    
        $user = $query->get();
    
        return view('user_list.index', compact('users'));
    }


<<<<<<< HEAD
    // add user 
=======
    // add user (admin privilege only)
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            
        ]);
>>>>>>> JH_20250419_1


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
