<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAssetMaintenance;
use App\Models\ITAsset;

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

    public function showByAsset($assetId)
    {
    $asset = ITAsset::with('maintenanceRecords')->findOrFail($assetId);

    return view('ITAssetMaintenance', compact('asset'));
    }

}
