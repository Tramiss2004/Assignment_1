<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller

{
    public function index()
    {
        $licenses = License::all();
        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        License::create($request->all());
        return redirect()->route('licenses.index')->with('success', 'License added successfully!');
    }

    public function edit($id)
    {
        $license = License::findOrFail($id);
        return view('licenses.edit', compact('license'));
    }

    public function update(Request $request, $id)
    {
        $license = License::findOrFail($id);
        $license->update($request->all());
        return redirect()->route('licenses.index')->with('success', 'License updated successfully!');
    }

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();
        return redirect()->route('licenses.index')->with('success', 'License deleted successfully!');
    }
}
