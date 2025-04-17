<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAssetMaintenance;

class ITAssetMaintenanceController extends Controller
{

    public function show($id){
        $data = ITAssetMaintenance::find($id);

    if (!$data) {
        return abort(404, "Asset not found");
    }

    return view("ITAssetMaintenance", [
        'data' => $data,
    ]);
    }
}
