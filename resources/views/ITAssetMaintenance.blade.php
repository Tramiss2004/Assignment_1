<h1>This is IT Asset Maintenance Page for {{$data -> name}}</h1><br>


<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">

</head>

<body>


<h2 style="text-align: center;">IT Asset Maintenance Details (ID: {{ $data->id }})</h2>

<div class="card">
    @foreach ($data->getAttributes() as $key => $value)
        <div class="row">
            <div class="label">{{ str_replace('_', ' ', $key) }}</div>
            <div class="value">{{ $value ?? 'N/A' }}</div>
        </div>
    @endforeach
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="{{ url('/it_asset/' . $data->id) }}" class="btn-back">Back to IT Asset Details</a>
</div>

</body>


<x-footer />
