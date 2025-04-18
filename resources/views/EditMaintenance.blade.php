<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Maintenance Record</title>
    <link rel="stylesheet" href="{{ asset('css/UpdateMaintenance.css') }}">
</head>
<body>

    <div class="card">
        <h1 style="text-align: center; color: #343a40; margin-bottom: 30px;">Edit Maintenance Record</h1>

        <form action="{{ url('/it_asset_maintenance/update/' . $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <span class="label">Title:</span>
                <input type="text" name="title" value="{{ $maintenance->title }}" class="form-control" required>
            </div>

            <div class="row">
                <span class="label">Description:</span>
                <textarea name="description" class="form-control">{{ $maintenance->description }}</textarea>
            </div>

            <div class="row">
                <span class="label">Status:</span>
                <select name="status" class="form-control" required>
                    <option value="Done" {{ $maintenance->status == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Pending" {{ $maintenance->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="row">
                <span class="label">Cost:</span>
                <input type="number" step="0.01" name="maintenance_cost" value="{{ $maintenance->maintenance_cost }}" class="form-control">
            </div>

            <div class="row">
                <span class="label">Start Date:</span>
                <input type="date" name="start_date" value="{{ $maintenance->start_date }}" class="form-control" required>
            </div>

            <div class="row">
                <span class="label">End Date:</span>
                <input type="date" name="end_date" value="{{ $maintenance->end_date }}" class="form-control">
            </div>

            <div class="row">
                <span class="label">Maintenance Type:</span>
                <select name="maintenance_type" class="form-control" required>
                    <option value="Service" {{ $maintenance->maintenance_type == 'Service' ? 'selected' : '' }}>Service</option>
                    <option value="Repair" {{ $maintenance->maintenance_type == 'Repair' ? 'selected' : '' }}>Repair</option>
                </select>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn-update">Update</button>
                <a href="{{ url()->previous() }}" class="btn-back">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
