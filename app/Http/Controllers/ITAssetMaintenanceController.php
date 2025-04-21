<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAssetMaintenance;
use App\Models\ITAsset;

class ITAssetMaintenanceController extends Controller
{


    public function showByAsset($assetId)
    {
    $asset = ITAsset::with('maintenanceRecords')->findOrFail($assetId);  // Get maintenance record based on Asset ID

    return view('ITAssetMaintenance', compact('asset'));
    }

    public function destroy($id)
    {
        $itAssetMaintenance = ITAssetMaintenance::findOrFail($id);
        $assetId = $itAssetMaintenance->it_asset_id; // Get related asset ID before deleting
        $itAssetMaintenance->delete();

        return redirect()->url('/it_asset_maintenance/delete/' . $assetId)->with('success', 'IT Asset Maintenance deleted successfully!');
    }

    public function edit($id)
    {
        $maintenance = ITAssetMaintenance::findOrFail($id);
        return view('EditMaintenance', compact('maintenance'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = ITAssetMaintenance::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'maintenance_cost' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'maintenance_type' => 'required|string|in: Service, Repair',
        ]);

        $maintenance->update($validated);

        return redirect('/it_asset_maintenance/asset/' . $maintenance->it_asset_id)
            ->with('success', 'Maintenance record updated successfully!');
    }

    public function showList()
    {
        $maintenanceListData = ITAssetMaintenance::all(); // Get all maintenance records

        return view('ViewMaintenanceList', compact('maintenanceListData'));
    }

    public function show($id)
    {
        $maintenance = ITAssetMaintenance::findOrFail($id); // Get maintenance record based on Maintenance ID

        return view('ViewMaintenanceDetail', compact('maintenance'));
    }

    public function create()
    {
        $itAssets = ITAsset::all(); // This should be ITAsset, not ITAssetMaintenance
        return view('CreateMaintenanceView', compact('itAssets'));
    }

    public function store(Request $request)
    {

        // Validate the data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'it_asset_id' => 'required|exists:it_assets,id',
            'status' => 'required|in:Pending,In Progress,Completed',
            'maintenance_cost' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'maintenance_type' => 'required|string|in:Service,Repair',
        ]);

        // Create the IT Asset Maintenance record
        ITAssetMaintenance::create($validatedData);

        // Redirect with success message
        return redirect()->route('ViewMaintenanceList')->with('success', 'IT Asset Maintenance created successfully!');
    }



}
