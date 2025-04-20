<?php

namespace App\Http\Controllers;

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
                ->orWhere('date_purchase', 'LIKE', "%{$search}%");
            });
        }
        // to check the role of the user, if user is staff, will filter IT Asset where the IT Asset is assign to them 
        if (Auth::check() && Auth::user()->isStaff()) {
            // Staff can only see their own assigned assets
            $query->where('user_id', Auth::id());
        }
        // Admin can see everything (no additional filter)
        $itAssets = $query->get();
        //go to the index of IT Asset view while passing the data
        return view('it_assets.index', compact('itAssets'));
    }

    public function create()
    {
        return view('license.create');
    }

    public function store(Request $request)
    {
        License::create($request->all());
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
