<h1>This is IT Asset Page for {{$data -> name}}</h1><br>


<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
</head>

<body>


<h2 style="text-align: center;">IT Asset Details (ID: {{ $data->id }})</h2>

<div class="card">
    @foreach ($data->getAttributes() as $key => $value)
        <div class="row">
            <div class="label">{{ str_replace('_', ' ', $key) }}</div>
            <div class="value">{{ $value ?? 'N/A' }}</div>
        </div>
    @endforeach
</div>

<div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
    <a href="{{ url('/it_assetListPage') }}" class="btn-back">Back To List</a>
    <a href="{{ url('/it_asset_maintenance/' . $data->id) }}" class="btn-back">Go to IT Asset Maintenance Details</a>
</div>

</body>


<x-footer />
