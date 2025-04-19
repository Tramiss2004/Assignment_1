<h1>This is IT Asset Maintenance Detail Page for {{$maintenance -> ID}}</h1><br>


<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">

</head>

<body>

    @php
        $mockIsAdmin = true; // Simulate admin or staff login
    @endphp

<h2 style="text-align: center;">IT Asset Maintenance Details (ID: {{ $maintenance->id }})</h2>


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

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ url() -> previous() }}" class="btn-back">Back to IT Asset Maintenance List</a>




</div>

</body>


<x-footer />
