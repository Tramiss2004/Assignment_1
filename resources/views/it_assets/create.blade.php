<div class="container">
    <h2>Create New IT Asset</h2>

    <form action="{{ route('it_assets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Asset Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Assigned Status</label>
            <select name="assigned_status" class="form-control" required>
                <option value="Assigned">Assigned</option>
                <option value="Unassigned">Unassigned</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Operating System</label>
            <input type="text" name="operating_system" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Purchase Date</label>
            <input type="date" name="date_purchase" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Serial Number</label>
            <input type="text" name="serial_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Running">Running</option>
                <option value="Failure">Failure</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create IT Asset</button>
    </form>
</div>
<x-footer />