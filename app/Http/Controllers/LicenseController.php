<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\License;
use App\Models\ITAsset;
use App\Models\ITAssetLicenseDetail;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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

        $user = Auth::user(); 

        if ($user && $user->is_admin == 1) {
            // Admin: show all licenses and linked assets/users
            $licenses = $query->with(['itAssets.user'])->get();
        } else {
            // Staff: only show licenses linked to their devices
            $licenses = $query->whereHas('itAssets', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['itAssets' => function ($q) use ($user) {
                $q->where('user_id', $user->id)->with('user');
            }])->get();
        }

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
            'serial_no' => 'required|string|max:10|unique:licenses,serial_no',
            'vendor' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'license_type' => 'required|string|in:Permanent,Renewable',
            'product_key' => 'required|string|max:16|unique:licenses,product_key',
            'quantity' => 'required|integer|min:2',
        ]);
        License::create($license_data);
        return redirect()->route('license.index')->with('success', 'License added successfully!');
    }

    public function show($id)
    {
        $license = License::with('itAssets.user')->findOrFail($id);

        return view('license.show', ['license' => $license]);
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
