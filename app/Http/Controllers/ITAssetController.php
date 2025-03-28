<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ITAsset;

class ITAssetController extends Controller
{
    public function index() // Define a function
    {
        $itAssets = ITAsset::all(); // Fetch all IT Assets from database
        return view('it_assets.index', compact('itAssets'));
    }

    public function show($id)
    {
        $itAsset = ITAsset::findOrFail($id); // Fetch asset by ID or fail
        return view('it_assets.show', compact('itAsset'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'assigned_status' => 'required|in:Assigned,Unassigned',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'serial_no' => 'required|string|max:191|unique:it_assets,serial_no',
            'status' => 'required|in:Running,Failure',
        ]);

        ITAsset::create($request->all());

        return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    }

}
