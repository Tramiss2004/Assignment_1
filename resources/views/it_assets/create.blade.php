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
            <select name="assigned_status" class="form-control" required>
                <option value="Assigned" {{ old('assigned_status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                <option value="Unassigned" {{ old('assigned_status') == 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
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
            <input type="text" name="operating_system" class="form-control" value="{{ old('operating_system') }}" required>
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
            <label class="form-label">Warranty Available</label>
            <select name="warranty_available" class="form-control">
                <option value="1" {{ old('warranty_available') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('warranty_available') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Warranty Due Date</label>
            <input type="date" name="warranty_due_date" class="form-control" value="{{ old('warranty_due_date') }}">
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
<<<<<<< HEAD
</div>
<x-footer />
=======
</div>
>>>>>>> origin/AL
