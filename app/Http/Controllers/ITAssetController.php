<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ITAsset;
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
        $itAsset = ITAsset::findOrFail($id); // Get the IT asset by ID
        $users = User::orderBy('name')->get(); // Fetch all users for the dropdown (if assigned) and ordered by user name
        return view('it_assets.edit', compact('itAsset', 'users'));
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
        ];
        $validatedData = $request->validate($validationRules);
        // Prepare data for update array
        $dataToUpdate = $validatedData;
        // Change 'warranty_available' from 'Yes'/'No' to 1/0 for DB
        $dataToUpdate['warranty_available'] = ($validatedData['warranty_available'] === 'Yes') ? 1 : 0;
        // Set the actual 'user_id' based on 'assigned_status'
        if ($validatedData['assigned_status'] == 'Assigned') {
            $dataToUpdate['user_id'] = $validatedData['assigned_user_id'];
        } else {
            $dataToUpdate['user_id'] = null;
        }
        unset($dataToUpdate['assigned_user_id']);
        // Update the data in DB
        $itAsset->update($dataToUpdate);
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
        // The actual DB column is 'user_id', not 'assigned_user_id'
        unset($dataToCreate['assigned_user_id']);

        // Create the IT Asset record
        ITAsset::create($dataToCreate);
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
