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

        <!-- resources/views/license/edit.blade.php -->
        <h1>Edit License</h1>
        <form method="POST" action="{{ route('license.update', $id) }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="Existing license name">
        <button type="submit">Update</button>
        /form>


            <button type="submit" class="btn btn-primary">Update Asset</button>
            <a href="{{ route('it_assets.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<x-footer />
