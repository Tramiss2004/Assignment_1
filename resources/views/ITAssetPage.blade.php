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
            <div class="value">{{ $value ?? 'null' }}</div>
        </div>
    @endforeach
</div>

</body>


<x-footer />
