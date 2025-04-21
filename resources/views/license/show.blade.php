<head>
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
</head>

<div class="container">
    <h2>License Details</h2>

    <p>Showing license with ID: {{ $license->id }}</p>
    <table border="1" class="table table-bordered">
        <tr>
            <th>ID:</th>
            <td>{{ $license->id }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $license->name }}</td>
        </tr>
        <tr>
            <th>Version:</th>
            <td>{{ $license->version }}</td>
        </tr>
        <tr>
            <th>Expiry Date:</th>
            <td>{{ $license->expiry_date }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $license->status }}</td>
        </tr>
        <tr>
            <th>Serial No:</th>
            <td>{{ $license->serial_no }}</td>
        </tr>
        <tr>
            <th>Vendor:</th>
            <td>{{ $license->vendor }}</td>
        </tr>
        <tr>
            <th>Purchase Date:</th>
            <td>{{ $license->date_purchase }}</td>
        </tr>
        <tr>
            <th>License Type:</th>
            <td>{{ $license->license_type }}</td>
        </tr>
        <tr>
            <th>Product Key:</th>
            <td>{{ $license->product_key }}</td>
        </tr>
        <tr>
            <th>Quantity:</th>
            <td>{{ $license->quantity }}</td>
        </tr>
    </table>

    <br>

    <table border="1" class="table table-bordered"> 
        <h2>IT Assets Associated with this License</h2>
        <thead>
            <tr>
                <th>Asset ID</th>
                <th>Name</th>
                <th>Model</th>
                <th>Brand</th>
                <th>Serial No</th>
                <th>Department</th>
                <th>User</th> <!-- if you want to show assigned user -->
            </tr>
        </thead>
        <tbody>
            @foreach($license->itAssets as $asset)
                <tr>
                    <td>{{ $asset->id }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->model }}</td>
                    <td>{{ $asset->brand }}</td>
                    <td>{{ $asset->serial_no }}</td>
                    <td>{{ $asset->department }}</td>
                    <td>{{ optional($asset->user)->name ?? 'N/A' }}</td> <!-- assuming ITAsset belongs to a User -->
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('license.index') }}" class="btn btn-primary">Back to List</a>
</div>
<x-footer />
