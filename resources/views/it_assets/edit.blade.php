<div class="container">
        <h2>Edit IT Asset</h2>
        
        <form action="{{ route('it_assets.update', $itAsset->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <input type="hidden" name="id" value="{{ $itAsset->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Asset Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $itAsset->name }}" required>
            </div>

            <div class="mb-3">
                <label for="assigned_status" class="form-label">Assigned Status</label>
                <select class="form-control" id="assigned_status" name="assigned_status" required>
                    <option value="Assigned" {{ $itAsset->assigned_status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                    <option value="Unassigned" {{ $itAsset->assigned_status == 'Unassigned' ? 'selected' : '' }}>Unassigned</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_purchase" class="form-label">Purchase Date</label>
                <input type="date" class="form-control" id="date_purchase" name="date_purchase" value="{{ $itAsset->date_purchase }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Asset</button>
            <a href="{{ route('it_assets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>