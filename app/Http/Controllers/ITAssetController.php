<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAsset;

class ITAssetController extends Controller
{
    public function show($id)
    {
        $data = ITAsset::find($id); // Fetch user by ID

    if (!$data) {
        abort(404); // Show a 404 error if user is not found
    }

    return view("ITAssetPage", ['data' => $data]);
    }
}
