<head>
    <title>GBN: Create IT Asset Maintenance</title>
    <!-- Link CSS -->
     <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}">
</head>

<div class="container">
    <h2>Create New IT Asset Maintenance Record</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('it_assetMaintenances.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter maintenance title" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Enter description" required>{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">IT Asset ID</label>
        <select name="it_asset_id" class="form-control" required>
            <option value="" disabled {{ old('it_asset_id') ? '' : 'selected' }}>-- Select IT Asset --</option>
            @foreach($itAssets as $asset)
                <option value="{{ $asset->id }}" {{ old('it_asset_id') == $asset->id ? 'selected' : '' }}>
                    {{ $asset->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="">-- Select Status --</option>
            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Maintenance Cost (RM)</label>
        <input type="number" step="0.01" name="maintenance_cost" class="form-control" placeholder="e.g., 250.00" value="{{ old('maintenance_cost') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">End Date (if available)</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Maintenance Type</label>
        <select name="maintenance_type" class="form-control" required>
            <option value="Service" {{ old('maintenance_type') == 'Service' ? 'selected' : '' }}>Service</option>
            <option value="Repair" {{ old('maintenance_type') == 'Repair' ? 'selected' : '' }}>Repair</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Create IT Asset Maintenance Detail</button>
    <button type="button" onclick="history.back()" class="btn btn-secondary">Back</button>
</form>

</div>

<x-footer />
