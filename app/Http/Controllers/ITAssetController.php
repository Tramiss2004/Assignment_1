<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAsset;
use App\Models\User;


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
        $users = User::all(); // Fetch all users from the database
        return view('it_assets.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'assigned_status' => 'required|in:Assigned,Unassigned',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'serial_no' => 'required|string|max:191|unique:it_assets,serial_no',
            'status' => 'required|in:Running,Failure',
            'warranty_due_date' => 'nullable|date',
            'license_available' => 'required|in:1,0',
            'license_id' => 'nullable|integer',
            'user_id' => 'nullable|integer',
        ]);

            ITAsset::create($validatedData);
    
            return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    }

    public function show($id)
    {

        // Convert 'Yes'/'No' to 1/0 for warranty_available
        $validatedData['warranty_available'] = $request->input('warranty_available') === 'Yes' ? 1 : 0;
    
        // Ensure assigned user is only set if status is "Assigned"
        if ($validatedData['assigned_status'] === 'Assigned') {
            $validatedData['user_id'] = $request->input('assigned_user_id'); 
        } else {
            $validatedData['user_id'] = null; // Ensure no user is saved if Unassigned
        }
    
        ITAsset::create($validatedData);
    
        return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    }
    
}

