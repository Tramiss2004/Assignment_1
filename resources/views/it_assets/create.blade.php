<div class="container">
    <h2>Create New IT Asset</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('it_assets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Asset Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Assigned Status</label>
            <select name="assigned_status" id="assigned_status" class="form-control" required onchange="toggleAssignedUser()">
                <option value="Unassigned" {{ old('assigned_status') == 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
                <option value="Assigned" {{ old('assigned_status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
            </select>
        </div>

        <!-- User selection appears only if 'Assigned' is chosen -->
        <div class="mb-3" id="assigned_user_div" style="display: none;">
            <label class="form-label">Assign to User</label>
            <select name="assigned_user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" value="{{ old('model') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Operating System</label>
            <select name="operating_system" class="form-control" required>
                <option value="Windows 10" {{ old('operating_system') == 'Windows 10' ? 'selected' : '' }}>Windows 10</option>
                <option value="Windows 11" {{ old('operating_system') == 'Windows 11' ? 'selected' : '' }}>Windows 11</option>
                <option value="macOS Ventura" {{ old('operating_system') == 'macOS Ventura' ? 'selected' : '' }}>macOS Ventura</option>
                <option value="macOS Monterey" {{ old('operating_system') == 'macOS Monterey' ? 'selected' : '' }}>macOS Monterey</option>
                <option value="Linux Ubuntu" {{ old('operating_system') == 'Linux Ubuntu' ? 'selected' : '' }}>Linux Ubuntu</option>
                <option value="Linux Fedora" {{ old('operating_system') == 'Linux Fedora' ? 'selected' : '' }}>Linux Fedora</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Purchase Date</label>
            <input type="date" name="date_purchase" class="form-control" value="{{ old('date_purchase') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Serial Number</label>
            <input type="text" name="serial_no" class="form-control" value="{{ old('serial_no') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Running" {{ old('status') == 'Running' ? 'selected' : '' }}>Running</option>
                <option value="Failure" {{ old('status') == 'Failure' ? 'selected' : '' }}>Failure</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Warranty Due Date</label>
            <input type="date" name="warranty_due_date" id="warranty_due_date" class="form-control" value="{{ old('warranty_due_date') }}" onchange="calculateWarranty()">
        </div>

        <!-- Warranty Availability is calculated automatically -->
        <div class="mb-3">
            <label class="form-label">Warranty Available</label>
            <input type="text" id="warranty_available" name="warranty_available" class="form-control" value="{{ old('warranty_available') == 1 ? 'Yes' : 'No' }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">License Available</label>
            <select name="license_available" class="form-control">
                <option value="1" {{ old('license_available') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('license_available') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create IT Asset</button>
    </form>

</div>

<script>
    function calculateWarranty() {
        let warrantyDueDate = document.getElementById("warranty_due_date").value;
        let warrantyAvailable = document.getElementById("warranty_available");

        if (!warrantyDueDate) {
            warrantyAvailable.value = "No"; // Display No
            warrantyAvailable.setAttribute("data-value", "0"); // Store 0 internally
            return;
        }

        let today = new Date();
        let dueDate = new Date(warrantyDueDate);

        let isWarrantyValid = dueDate >= today ? 1 : 0;
        warrantyAvailable.value = isWarrantyValid ? "Yes" : "No"; // Display Yes/No
        warrantyAvailable.setAttribute("data-value", isWarrantyValid); // Store 1/0
    }


    function toggleAssignedUser() {
        let assignedStatus = document.getElementById("assigned_status").value;
        let assignedUserDiv = document.getElementById("assigned_user_div");

        assignedUserDiv.style.display = (assignedStatus === "Assigned") ? "block" : "none";
    }

    // Run calculations on page load if values exist
    document.addEventListener("DOMContentLoaded", function () {
        calculateWarranty();
        toggleAssignedUser();
    });
</script>

<x-footer />

