<h1>This is IT Asset Maintenance Page for {{$asset -> name}}</h1><br>


<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">

</head>

<body>

    @php
        $mockIsAdmin = true; // Simulate admin or staff login
    @endphp

<h2 style="text-align: center;">IT Asset Maintenance Details (ID: {{ $asset->id }})</h2>

@if ($asset->maintenanceRecords->count() > 0)
    @foreach ($asset->maintenanceRecords as $maintenance)
        <div class="card">
            <div class="row"><strong>Title:</strong> {{ $maintenance->title }}</div>
            <div class="row"><strong>Description:</strong> {{ $maintenance->description }}</div>
            <div class="row"><strong>IT Asset ID:</strong> {{ $maintenance->it_asset_id }}</div>
            <div class="row"><strong>Status:</strong> {{ $maintenance->status }}</div>
            <div class="row"><strong>Maintenance Cost:</strong> RM{{ $maintenance->maintenance_cost ?? 'N/A' }}</div>
            <div class="row"><strong>Start Date:</strong> {{ $maintenance->start_date }}</div>
            <div class="row"><strong>End Date:</strong> {{ $maintenance->end_date ?? 'Ongoing' }}</div>
            <div class="row"><strong>Maintenance Type:</strong> {{ $maintenance->maintenance_type }}</div>
            <div class="row"><strong>Created At:</strong> {{ $maintenance->created_at }}</div>
            <div class="row"><strong>Updated At:</strong> {{ $maintenance->updated_at }}</div>
        </div>
        <br>
    @endforeach
@else
    <p style="text-align: center;">No maintenance records found for this asset.</p>
@endif

<div style="text-align: center; margin-top: 20px;">
    <a href="{{ url('/it_asset/' . $asset->id) }}" class="btn-back">Back to IT Asset Details</a>


    @if($mockIsAdmin)
                <a href="#" class="btn-update">Update</a>
                <a href="#" class="btn-delete">Delete</a> <!-- Dummy delete button -->
    @endif


    {{--
        This is a comment and actual code to use when auth is set up

    @if(Auth::check() && Auth::user()->is_admin)
        <a href="#" class="btn-update">Update</a>
        <a href="#" class="btn-delete">Delete</a>
    @endif
    --}}

</div>

</body>


<x-footer />
