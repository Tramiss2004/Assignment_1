<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAsset;
use App\Models\License;
use App\Models\ITAssetLicenseDetail;
use App\Models\User;
use Carbon\Carbon;

class ITAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = ITAsset::query();
        // if got search, apply filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('serial_no', 'LIKE', "%{$search}%")
                ->orWhere('category', 'LIKE', "%{$search}%")
                ->orWhere('brand', 'LIKE', "%{$search}%")
                ->orWhere('model', 'LIKE', "%{$search}%")
                ->orWhere('operating_system', 'LIKE', "%{$search}%")
                ->orWhere('assigned_status', 'LIKE', "%{$search}%");
            });
        }
        // to check the role of the user, if user is staff, will filter IT Asset 
        // where the IT Asset is assign to them 
        if (Auth::check() && Auth::user()->isStaff()) {
            // Staff can only see their own assigned assets
            $query->where('user_id', Auth::id());
        }
        // Admin can see everything (no additional filter)
        $itAssets = $query->get();
        //go to the index of IT Asset view while passing the data
        return view('it_assets.index', compact('itAssets'));
    }
    //see IT Asset details for single asset
    public function show($id)
    {
        $asset = ITAsset::with('assignedUser')->findOrFail($id);
        if (!$asset) {
            return abort(404, "Asset not found");
        }
        else{
            return view("it_assets.show", [
                'asset'=>$asset
            ]);
        }
    }

    public function edit($id)
    {
        $itAsset = ITAsset::findOrFail($id); 
        $users = User::orderBy('name')->get();
        $allLicenses = License::orderBy('name')->get(); //get all licenses
        $assignedLicenses = DB::table('it_asset_license_details') //get assigned licese 
        ->join('licenses', 'it_asset_license_details.license_id', '=', 'licenses.id')
        ->where('it_asset_license_details.it_asset_id', $id)  //for this it asset
        ->select('licenses.id', 'licenses.name', 'licenses.version')
        ->get();
        return view('it_assets.edit', compact('itAsset', 'users', 'allLicenses', 'assignedLicenses'));
    }

    public function update(Request $request, $id)
    {
        // check for exiting IT Asset using the ID
        $itAsset = ITAsset::findOrFail($id);
        // Validation
        $validationRules = [
            'name' => 'required|string|max:255',
            'assigned_status' => 'required|in:Assigned,Unassigned',
            'category' => 'required|string|max:255', 
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255', 
            'date_purchase' => 'required|date',
            'serial_no' => ['required','string','max:191',Rule::unique('it_assets')->ignore($itAsset->id)],
            'status' => 'required|in:Running,Failure',
            'warranty_available' => 'required|in:Yes,No', 
            'warranty_due_date' => 'nullable|date',
            'license_available' => 'required|in:1,0', 
            'assigned_user_id' => 'required_if:assigned_status,Assigned|nullable|exists:users,id',
            'license_action' => 'nullable|in:none,assign,unassign',
            ];
        $validatedData = $request->validate($validationRules);
        $dataToUpdate = $validatedData;
        $dataToUpdate['warranty_available'] = ($validatedData['warranty_available'] === 'Yes') ? 1 : 0;
        $dataToUpdate['user_id'] = $validatedData['assigned_status'] === 'Assigned' ? $validatedData['assigned_user_id'] : null;
        unset($dataToUpdate['assigned_user_id']);
        $itAsset->update($dataToUpdate);
        // Handle license actions
        if ($validatedData['license_action'] === 'unassign' && $request->filled('license_id')) {
            ITAssetLicenseDetail::where('it_asset_id', $itAsset->id)
                ->where('license_id', $request->input('license_id'))
                ->delete();
        }
        if ($validatedData['license_action'] === 'assign' && $request->filled('license_id')) {
            // Prevent duplicate entry for assign license
            ITAssetLicenseDetail::updateOrCreate(
                ['it_asset_id' => $itAsset->id, 'license_id' => $request->input('license_id')],
                []
            );
        }
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
        $users = User::all(); //Get all users
        $licenses = License::all(); // Get all licenses
        //pass thru the user and license details to the create page
        return view('it_assets.create', compact('users', 'licenses')); 
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
            'warranty_available' => 'required|in:Yes,No',
            'warranty_due_date' => 'nullable|date',
            'license_available' => 'required|in:1,0',
            'license_id' => 'nullable|integer',
            'assigned_user_id' => 'required_if:assigned_status,Assigned|nullable|exists:users,id',
        ]);
        $dataToCreate = $validatedData; 
        // Convert 'warranty_available' from 'Yes'/'No' to 1/0
        $dataToCreate['warranty_available'] = 
        ($validatedData['warranty_available'] === 'Yes') ? 1 : 0;
        // Set the actual 'user_id' based on 'assigned_status'
        if ($validatedData['assigned_status'] == 'Assigned') {
            // Use the validated ID submitted from the 'assigned_user_id' select dropdown
            $dataToCreate['user_id'] = $validatedData['assigned_user_id'];
        } else {
            // If status is 'Unassigned', ensure user_id is null
            $dataToCreate['user_id'] = null;
        }
        unset($dataToCreate['assigned_user_id']);
        //check for unique serial_no
        if (ITAsset::where('serial_no', $validatedData['serial_no'])->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['serial_no' => 'The serial number already exists.']);
        }
        //Create data into the DB
        $asset = ITAsset::create($dataToCreate);
        // If license_available is 1 and license was selected, assign it
        if ($validatedData['license_available'] == 1 && $request->input('license_selection')) {
            DB::table('it_asset_license_details')->insert([
                'it_asset_id' => $asset->id,
                'license_id' => $request->input('license_selection'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    }

    // public function show($id, Request $request)
    // {

    //     // Convert 'Yes'/'No' to 1/0 for warranty_available
    //     $validatedData['warranty_available'] = $request->input('warranty_available') === 'Yes' ? 1 : 0;

    //     // Ensure assigned user is only set if status is "Assigned"
    //     if ($validatedData['assigned_status'] === 'Assigned') {
    //         $validatedData['user_id'] = $request->input('assigned_user_id');
    //     } else {
    //         $validatedData['user_id'] = null; // Ensure no user is saved if Unassigned
    //     }

    //     ITAsset::create($validatedData);

    //     return redirect()->route('it_assets.index')->with('success', 'IT Asset created successfully!');
    // }

}
