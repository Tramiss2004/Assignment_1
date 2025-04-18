<h1> This is a list of IT assets</h1>

<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
    </head>
<div class="container">
    
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap search-container">
    <!-- Search Form -->
    <form method="GET" action="{{ route('it_assets.index') }}" class="d-flex flex-row mb-2 mb-md-0">
        <input type="text" name="search" class="form-control me-2" placeholder="Search IT Assets" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- New IT Asset Button -->
    <form action="{{ route('it_assets.create') }}" method="GET">
        <button type="submit" class="btn btn-info">New IT Asset</button>
    </form>
</div>

    <table border="1" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Assigned Status</th>
                <th>Purchase Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itAssets as $asset)
            <tr>
                <td>{{ $asset->id }}</td>
                <td>{{ $asset->name }}</td>
                <td>{{ $asset->assigned_status }}</td>
                <td>{{ $asset->date_purchase }}</td>
                <td>
                    <a href="{{ route('it_assets.show', $asset->id) }}" class="btn btn-back">View</a>
                    <!-- if is admin -->
                    <a href="{{ route('it_assets.edit', $asset->id) }}" class="btn btn-update">Edit</a>
                   
                    <form action="{{ route('it_assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this asset?');">Delete</button>
                    <!-- end if is admin -->
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<x-footer />