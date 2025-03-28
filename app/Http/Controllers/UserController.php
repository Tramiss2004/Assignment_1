<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

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
