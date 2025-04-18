<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Cookies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $user = User::where('name', $request->username)->first();
            $request->session()->put('name', $user->name);
            $request->session()->put('user_id', $user->id);
            // Login successful, redirect to menu
            return redirect()->intended('/Menu');
        } else {
            // Login failed, redirect back with error message
            return back()->withInput($request->only('username'))->withErrors(['password' => 'Invalid credentials']);
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


    // add user (admin privilege only)
    public function create(Request $request){
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

    return view("ProfilePage", [
        'data' => $data,
    ]);
    }
}
