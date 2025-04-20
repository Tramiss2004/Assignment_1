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
            $request->session()->put('is_admin', $user->is_admin);
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
    
        $Users = $query->get();
    
        return view('user_list.index', compact('Users'));
    }


    // add user (admin privilege only)
    public function create(){
        
        return view('user_list.create');   
    }

    // store user data (admin privilege only)
    public function store(Request $request){
        $validated_data = $request->validate([
            'name' => 'required|min:4',
            'is_admin' => 'required|in:Yes,No',
            'position' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // change is_admin to 0 or 1
        if($validated_data['is_admin'] == 'Yes'){
            $validated_data['is_admin'] = 1;
        }else{
            $validated_data['is_admin'] = 0;
        }

        User::create($validated_data);

        return redirect()->route('user_list.index')->with('success', 'User created successfully.');
    }

    // show the user detail (for Admin section)
    public function show($id){
        $user = User::find($id);

        if(!$user){
            return abort(404, "User not found");
        }

        return view("user_list.show", ['user' => $user]);

    }

    // edit user data (admin privilege only)
    public function edit($id){
        $user = User::findOrFail($id);
        return view('user_list.edit', compact('user'));
    }

    // update user data (admin privilege only)
    public function update(Request $request, $id){
        //check for existing User using the ID
        $user = User::findOrFail($id);

        // Validation
        $validationRules = [
            'name' => 'required|min:4',
            'is_admin' => 'required|in:Yes,No',
            'position' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];

        $validated_data = $request->validate($validationRules);

        // Prepare data for update array
        $dataToUpdate = $validated_data;
        // change is_admin to 0 or 1
        if($validated_data['is_admin'] == 'Yes'){
            $dataToUpdate['is_admin'] = 1;
        }
        else{
            $dataToUpdate['is_admin'] = 0;
        }

        // Update the data in DB
        $user->update($dataToUpdate);
        return redirect()->route('user_list.index')->with('success', 'User updated successfully!');
    }


    // destroy user data (admin privilege only)
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user_list.index')->with('success', 'User deleted successfully!');
    }



    // show user data (for Profile Page)
    public function showData($id, Request $request){
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
