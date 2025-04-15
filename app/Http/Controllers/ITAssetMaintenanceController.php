<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAssetMaintanance;

class ITAssetMaintenanceController extends Controller
{

    public function show($id){
        $data = ITAssetMaintanance::find($id);

    if (!$data) {
        return abort(404, "Asset not found");
    }

    return view("ITAssetMaintenance", [
        'data' => $data,
    ]);
    }
}
