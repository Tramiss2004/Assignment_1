{{-- Use the $asset variable passed from the controller --}}
<h1>This is IT Asset Page for {{ $asset->name }}</h1><br>

<head>
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
</head>

<body>

<h2 style="text-align: center;">IT Asset Details (Asset ID: {{ $asset->id }})</h2>

{{-- Display Asset Details - Iterate explicitly or list fields --}}
<div class="card">
    @php
        // Define which fields to display from the asset model
        $assetFields = [
            'id' => 'ID',
            'name' => 'Asset Name',
            'assigned_status' => 'Assigned Status',
            'category' => 'Category',
            'brand' => 'Brand',
            'model' => 'Model',
            'operating_system' => 'Operating System',
            'serial_no' => 'Serial Number',
            'date_purchase' => 'Purchase Date',
            'status' => 'Status',
            'warranty_due_date' => 'Warranty Due Date',
            'warranty_available' => 'Warranty Available',
            'license_available' => 'License Available',
        ];
    @endphp

    @foreach ($assetFields as $field => $label)
        <div class="row">
            <div class="label">{{ $label }}</div>
            <div class="value">
                @if ($field === 'warranty_available' || $field === 'license_available')
                    {{ $asset->$field == 1 ? 'Yes' : 'No' }} {{-- Display Yes/No --}}
                @else
                    {{ $asset->$field ?? 'N/A' }}
                @endif
            </div>
        </div>
    @endforeach
</div>

{{-- Display Assigned User Details Conditionally --}}
<h3 style="text-align: center; margin-top: 20px;">Assigned User Details</h3>
@if ($asset->assignedUser) {{-- Check if the relationship loaded a user --}}
    <div class="card">
         <div class="row">
             <div class="label">User ID</div>
             {{-- Access properties via the relationship --}}
             <div class="value">{{ $asset->assignedUser->id }}</div>
         </div>
         <div class="row">
             <div class="label">User Name</div>
             <div class="value">{{ $asset->assignedUser->name }}</div>
         </div>
         {{-- Add other user fields if needed: $asset->assignedUser->email etc. --}}
    </div>
@else
    {{-- Displayed if $asset->assignedUser is null --}}
    <p style="text-align: center;">No user assigned to this asset.</p>
@endif


<div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
    <a href="{{ url('/it_assets') }}" class="btn-back">Back To List</a>
    <a href="{{ url('/it_asset_maintenance/asset/' . $asset->id) }}" class="btn-back">View Maintenance Details</a>
</div>

</body>

<x-footer />