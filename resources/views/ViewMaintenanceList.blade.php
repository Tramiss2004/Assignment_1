<h1> This is a list of IT assets maintenance details</h1>

<head>
    <title>GBN: IT Asset Maintenance</title>
    <link rel="stylesheet" href="{{ asset('css/ITAssetMaintenanceList.css') }}">
</head>
@php
        $mockIsAdmin = true; // Simulate admin or staff login
@endphp

<form action="{{ route('it_assetMaintenances.create') }}" method="GET">
    <button type="submit" class="btn btn-back">New IT Asset Maintanance</button>
</form>

<div class="container">
    <h2 class="table-title">IT Asset Maintenance List</h2>

    <table class="table table-bordered custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>IT Asset ID</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenanceListData as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->it_asset_id }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->maintenance_cost ?? 'N/A' }}</td>
                <td>{{ $data->maintenance_type }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('it_asset_maintenance.show', $data->id) }}" class="btn-back">View</a>

                        @if($mockIsAdmin)
                            <a href="{{ url('/it_asset_maintenance/edit/' . $data->id) }}" class="btn-update">Update</a>

                            <form action="{{ url('/it_asset_maintenance/delete/' . $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this maintenance record?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="/Menu" class="btn btn-back">Back</a>
    </div>
</div>
<x-footer />
