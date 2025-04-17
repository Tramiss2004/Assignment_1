<h1> This is a list of IT assets</h1>

<head>
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
</head>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Serial No.</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
    </thead>



    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->serial_no }}</td>
            <td>{{ $item->status }}</td>
            <td>
            <a href="{{ url('it_asset/' . $item->id) }}">View</a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table><br>

<x-footer />
