<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAsset;

class ITAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = ITAsset::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('serial_no', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('brand', 'LIKE', "%{$search}%")
                  ->orWhere('model', 'LIKE', "%{$search}%")
                  ->orWhere('operating_system', 'LIKE', "%{$search}%")
                  ->orWhere('assigned_status', 'LIKE', "%{$search}%");
        }
    
        $itAssets = $query->get();
    
        return view('it_assets.index', compact('itAssets'));
    }
    

    public function edit($id)
    {
        $itAsset = ITAsset::findOrFail($id); // Get the IT asset by ID
        return view('it_assets.edit', compact('itAsset')); // Show the edit form
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'assigned_status' => 'required|in:Assigned,Unassigned',
            'date_purchase' => 'required|date',
        ]);
    
        $itAsset = ITAsset::findOrFail($id);
        $itAsset->update([
            'name' => $request->name,
            'assigned_status' => $request->assigned_status,
            'date_purchase' => $request->date_purchase,
        ]);
    
        return redirect()->route('it_assets.index')->with('success', 'IT Asset updated successfully!');
    }
    
    public function destroy($id)
    {
        $itAsset = ITAsset::findOrFail($id);
        $itAsset->delete();

        return redirect()->route('it_assets.index')->with('success', 'IT Asset deleted successfully!');
    }

    public function create()
    {
        return view('it_assets.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'assigned_status' => 'required|in:Assigned,Unassigned',
            'category' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'serial_no' => 'required|string|max:191|unique:it_assets,serial_no',
            'status' => 'required|in:Running,Failure',
            'warranty_available' => 'required|boolean', // Add this line
            'warranty_due_date' => 'nullable|date',
            'license_available' => 'required|boolean', // Add this line
            'license_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
        ]);
 
        ITAsset::create($validatedData);

        return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    }

    public function show($id)
    {
        $data = ITAsset::find($id); // Fetch user by ID

        if (!$data) {
            abort(404); // Show a 404 error if user is not found
    }

    return view("ITAssetPage", ['data' => $data]);
    }
}
