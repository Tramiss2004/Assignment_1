<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update IT Asset</title>
    <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}"> {{-- Assuming same CSS --}}
    {{-- Add other necessary CSS/JS links (e.g., Bootstrap if needed) --}}
</head>
<body>

<div class="container">
    <h2>Update IT Asset (ID: {{ $itAsset->id }})</h2>

    {{-- Display validation errors if any --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('it_assets.update', $itAsset->id) }}" method="POST">
        @csrf {{-- CSRF Protection --}}
        @method('PUT') {{-- Method spoofing for UPDATE --}}

        {{-- Asset Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Asset Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $itAsset->name) }}" required>
        </div>

        {{-- Assigned Status --}}
        <div class="mb-3">
            <label for="assigned_status" class="form-label">Assigned Status</label>
            <select name="assigned_status" id="assigned_status" class="form-control" required onchange="toggleAssignedUser()">
                {{-- Use old() helper with fallback to current asset status --}}
                <option value="Unassigned" {{ old('assigned_status', $itAsset->assigned_status) == 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
                <option value="Assigned" {{ old('assigned_status', $itAsset->assigned_status) == 'Assigned' ? 'selected' : '' }}>Assigned</option>
            </select>
        </div>

        {{-- Assign to User (Conditional) --}}
        {{-- The initial display style is handled by the JS on DOMContentLoaded --}}
        <div class="mb-3" id="assigned_user_div" style="display: none;">
            <label for="assigned_user_id" class="form-label">Assign to User</label>
            <select name="assigned_user_id" id="assigned_user_id" class="form-control">
                 <option value="">-- Select User --</option> {{-- Add a default empty option --}}
                @foreach($users as $user)
                    {{-- Select based on old input or current asset's user_id --}}
                    <option value="{{ $user->id }}" 
                    {{ old('assigned_user_id', $itAsset->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>

                @endforeach
            </select>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $itAsset->category) }}" required>
        </div>

        {{-- Brand --}}
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" id="brand" name="brand" class="form-control" value="{{ old('brand', $itAsset->brand) }}" required>
        </div>

        {{-- Model --}}
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" id="model" name="model" class="form-control" value="{{ old('model', $itAsset->model) }}" required>
        </div>

        {{-- Operating System --}}
        <div class="mb-3">
            <label for="operating_system" class="form-label">Operating System</label>
            <select name="operating_system" id="operating_system" class="form-control" required>
                 {{-- Add more options as needed --}}
                 @php $currentOS = old('operating_system', $itAsset->operating_system); @endphp
                <option value="Windows 10" {{ $currentOS == 'Windows 10' ? 'selected' : '' }}>Windows 10</option>
                <option value="Windows 11" {{ $currentOS == 'Windows 11' ? 'selected' : '' }}>Windows 11</option>
                <option value="macOS Ventura" {{ $currentOS == 'macOS Ventura' ? 'selected' : '' }}>macOS Ventura</option>
                <option value="macOS Monterey" {{ $currentOS == 'macOS Monterey' ? 'selected' : '' }}>macOS Monterey</option>
                <option value="Linux Ubuntu" {{ $currentOS == 'Linux Ubuntu' ? 'selected' : '' }}>Linux Ubuntu</option>
                <option value="Linux Fedora" {{ $currentOS == 'Linux Fedora' ? 'selected' : '' }}>Linux Fedora</option>
                {{-- Add an option if the current OS isn't in the list? --}}
                @if (!in_array($currentOS, ['Windows 10', 'Windows 11', 'macOS Ventura', 'macOS Monterey', 'Linux Ubuntu', 'Linux Fedora']) && $currentOS)
                 <option value="{{ $currentOS }}" selected>{{ $currentOS }} (Other)</option>
                @endif
            </select>
            {{-- Or use an input if you prefer free text:
             <input type="text" id="operating_system" name="operating_system" class="form-control" value="{{ old('operating_system', $itAsset->operating_system) }}" required>
            --}}
        </div>

        {{-- Purchase Date --}}
        <div class="mb-3">
            <label for="date_purchase" class="form-label">Purchase Date</label>
            <input type="date" id="date_purchase" name="date_purchase" class="form-control" value="{{ old('date_purchase', $itAsset->date_purchase) }}" required>
        </div>

        {{-- Serial Number --}}
        <div class="mb-3">
            <label for="serial_no" class="form-label">Serial Number</label>
            <input type="text" id="serial_no" name="serial_no" class="form-control" value="{{ old('serial_no', $itAsset->serial_no) }}" required>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Running" {{ old('status', $itAsset->status) == 'Running' ? 'selected' : '' }}>Running</option>
                <option value="Failure" {{ old('status', $itAsset->status) == 'Failure' ? 'selected' : '' }}>Failure</option>
            </select>
        </div>

        {{-- Warranty Due Date --}}
        <div class="mb-3">
            <label for="warranty_due_date" class="form-label">Warranty Due Date</label>
            <input type="date" name="warranty_due_date" id="warranty_due_date" class="form-control" value="{{ old('warranty_due_date', $itAsset->warranty_due_date) }}" onchange="calculateWarranty()">
        </div>

        {{-- Warranty Available (Hidden Input Method) --}}
        <div class="mb-3">
            <label class="form-label">Warranty Available</label>
            {{-- Visible input for display only --}}
            <input type="text" id="warranty_available_display" class="form-control" value="{{ old('warranty_available', $itAsset->warranty_available) == 1 ? 'Yes' : 'No' }}" readonly>
            {{-- Hidden input that gets submitted --}}
            <input type="hidden" id="warranty_available" name="warranty_available" value="{{ old('warranty_available', $itAsset->warranty_available) == 1 ? 'Yes' : 'No' }}"> {{-- Initial value for JS --}}
        </div>
        
        {{-- License Available --}}
         <div class="mb-3">
            <label for="license_available" class="form-label">License Available</label>
            <select name="license_available" id="license_available" class="form-control" required>
                <option value="1" {{ old('license_available', $itAsset->license_available) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('license_available', $itAsset->license_available) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>
        
        {{-- License Action --}}
        <div class="mb-3">
            <label for="license_action" class="form-label">License Action</label>
            <select name="license_action" id="license_action" class="form-control" onchange="toggleLicenseAction()">
                <option value="none" {{ old('license_action') == 'none' ? 'selected' : '' }}>Do Nothing</option>
                <option value="assign" {{ old('license_action') == 'assign' ? 'selected' : '' }}>Assign License</option>
                <option value="unassign" {{ old('license_action') == 'unassign' ? 'selected' : '' }}>Unassign License</option>
            </select>
        </div>

        {{-- License Selection --}}
        <div class="mb-3" id="license_select_group" style="display: none;">
            <label for="license_id" class="form-label">Select License</label>
            <select name="license_id" id="license_id" class="form-control">
                <option value="">-- Select License --</option>
                
                {{-- Assignable Licenses --}}
                @foreach($allLicenses as $license)
                    <option class="license-option assign-option" value="{{ $license->id }}"
                        {{ old('license_id') == $license->id ? 'selected' : '' }}>
                        {{ $license->name }} ({{ $license->version }})
                    </option>
                @endforeach

                {{-- Assigned Licenses (for unassign) --}}
                @foreach($assignedLicenses as $license)
                    <option class="license-option unassign-option" value="{{ $license->id }}"
                        {{ old('license_id') == $license->id ? 'selected' : '' }}>
                        {{ $license->name }} ({{ $license->version }}) [Assigned]
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Buttons --}}
        <div class="mb-3">
             <button type="submit" class="btn btn-success">Update Asset</button>
             <a href="{{ route('it_assets.index') }}" class="btn btn-secondary">Cancel</a> {{-- Use a different class for Cancel maybe? --}}
        </div>
    </form>
</div>

<script>
    function calculateWarranty() {
        let warrantyDueDate = document.getElementById("warranty_due_date").value;
        let warrantyAvailableDisplay = document.getElementById("warranty_available_display"); // Visible field
        let warrantyAvailableHidden = document.getElementById("warranty_available"); // Hidden field
        if (!warrantyDueDate) {
            warrantyAvailableDisplay.value = "No";
            warrantyAvailableHidden.value = "No"; // avoid error for validation
        } else {
            let today = new Date();
            today.setHours(0, 0, 0, 0); 
            let dueDate = new Date(warrantyDueDate + 'T00:00:00'); 
            let isWarrantyValid = dueDate >= today; // true or false
            warrantyAvailableDisplay.value = isWarrantyValid ? "Yes" : "No";
            warrantyAvailableHidden.value = isWarrantyValid ? "Yes" : "No"; // Submit "Yes" or "No"
        }
    }

    function toggleAssignedUser() {
        let assignedStatus = document.getElementById("assigned_status").value;
        let assignedUserDiv = document.getElementById("assigned_user_div");
        let assignedUserSelect = document.getElementById("assigned_user_id");
        if (assignedStatus === "Assigned") {
            assignedUserDiv.style.display = "block";
        } else {
            assignedUserDiv.style.display = "none";
            assignedUserSelect.value = "";
        }
    }

    // Run calculations and toggle on page load
    document.addEventListener("DOMContentLoaded", function () {
        calculateWarranty(); 
        toggleAssignedUser(); 
        toggleLicenseDropdown(); 
        toggleLicenseAction();  
        document.getElementById('license_action').addEventListener('change', toggleLicenseAction); 
    });

    function toggleLicenseDropdown() {
        let licenseAvailable = document.getElementById("license_available").value;
        let licenseDiv = document.getElementById("license_selection_div");

        licenseDiv.style.display = (licenseAvailable === "1") ? "block" : "none";
    }

    function toggleLicenseAction() {
        const action = document.getElementById('license_action').value;
        const licenseGroup = document.getElementById('license_select_group');
        const licenseSelect = document.getElementById('license_id');
        const assignOptions = document.querySelectorAll('.assign-option');
        const unassignOptions = document.querySelectorAll('.unassign-option');
        licenseGroup.style.display = (action === 'assign' || action === 'unassign') ? 'block' : 'none';
        assignOptions.forEach(option => {
            option.style.display = (action === 'assign') ? 'block' : 'none';
        });
        unassignOptions.forEach(option => {
            option.style.display = (action === 'unassign') ? 'block' : 'none';
        });
        licenseSelect.value = '';
    }

</script>
</body>
</html>
<x-footer />
