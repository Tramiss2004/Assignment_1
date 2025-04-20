<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\License;

use Illuminate\Http\Request;

class LicenseController extends Controller

{
    public function index(Request $request)
    {
        $query = License::query();
        // if got search, apply filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('version', 'LIKE', "%{$search}%")
                ->orWhere('expiry_date', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%")
                ->orWhere('serial_no', 'LIKE', "%{$search}%")
                ->orWhere('vendor', 'LIKE', "%{$search}%")
                ->orWhere('date_purchase', 'LIKE', "%{$search}%")->orWhere('license_type', 'LIKE', "%{$search}%")->orWhere('product_key', 'LIKE', "%{$search}%")
                ->orWhere('quantity', 'LIKE', "%{$search}%");
            });
        }
        // Admin can see everything (no additional filter)
        $licenses = $query->get();
        //go to the index of License view while passing the data
        return view('license.index', compact('licenses'));
    }

    public function create()
    {
        return view('license.create');
    }

    public function store(Request $request)
    {
        $license_data = $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'expiry_date' => 'nullable|date',
            'status' => 'required|string|in:Valid,Expired',
            'serial_no' => 'required|string|max:255|unique:licenses,serial_no',
            'vendor' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'license_type' => 'required|string|in:Permanent,Renewable',
            'product_key' => 'required|string|max:255|unique:licenses,product_key',
            'quantity' => 'required|integer|min:1',
        ]);
        License::create($license_data);
        return redirect()->route('license.index')->with('success', 'License added successfully!');
    }

    public function edit($id)
    {
        $license = License::findOrFail($id);
        return view('license.edit', compact('license'));
    }

    public function update(Request $request, $id)
    {
        $license = License::findOrFail($id);
        $license->update($request->all());
        return redirect()->route('license.index')->with('success', 'License updated successfully!');
    }

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();
        return redirect()->route('license.index')->with('success', 'License deleted successfully!');
    }
}
