<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}">
</head>
<div class="container">
    <h2>Update IT Asset</h2>
    
    <form action="{{ route('it_assets.update', $itAsset->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $itAsset->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Asset Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $itAsset->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="assigned_status" class="form-label">Assigned Status</label>
            <select class="form-control" id="assigned_status" name="assigned_status" required>
                <option value="Assigned" {{ old('assigned_status', $itAsset->assigned_status) == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                <option value="Unassigned" {{ old('assigned_status', $itAsset->assigned_status) == 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $itAsset->category) }}" required>
        </div>

<<<<<<< HEAD
<!-- <<<<<<< HEAD
            <button type="submit" class="btn btn-primary">Update Asset</button>
            <a href="{{ route('it_assets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
======= -->
=======

>>>>>>> JH_20250419_1
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $itAsset->brand) }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $itAsset->model) }}" required>
        </div>

        <div class="mb-3">
            <label for="operating_system" class="form-label">Operating System</label>
            <input type="text" class="form-control" id="operating_system" name="operating_system" value="{{ old('operating_system', $itAsset->operating_system) }}" required>
        </div>

        <div class="mb-3">
            <label for="date_purchase" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="date_purchase" name="date_purchase" value="{{ old('date_purchase', $itAsset->date_purchase) }}" required>
        </div>

        <div class="mb-3">
            <label for="serial_no" class="form-label">Serial Number</label>
            <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ old('serial_no', $itAsset->serial_no) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Running" {{ old('status', $itAsset->status) == 'Running' ? 'selected' : '' }}>Running</option>
                <option value="Failure" {{ old('status', $itAsset->status) == 'Failure' ? 'selected' : '' }}>Failure</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Asset</button>
        <a href="{{ route('it_assets.index') }}" class="btn btn-back">Cancel</a>
    </form>
</div>
<<<<<<< HEAD
<!-- >>>>>>> origin/AL -->
=======
<x-footer />
>>>>>>> JH_20250419_1
