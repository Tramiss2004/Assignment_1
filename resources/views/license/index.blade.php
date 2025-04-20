<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
</head>


<div class="d-flex justify-content-between  mb-3 flex-wrap search-container">
    <h2>License List</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ route('license.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search License" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @auth
        @if(Auth::user()->isAdmin())
            <!-- New License Button -->
            <form action="{{ route('license.create') }}" method="GET">
                <button type="submit" class="btn btn-info">New License</button>
            </form>
        @endif
    @endauth

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Version</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Date Purchase</th>
                <th>License Type</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($licenses as $license)
            <tr>
                <td>{{ $license->id }}</td>
                <td>{{ $license->name }}</td>
                <td>{{ $license->version }}</td>
                <td>{{ $license->expiry_date }}</td>
                <td>{{ $license->status }}</td>
                <td>{{ $license->date_purchase }}</td>
                <td>{{ $license->license_type }}</td>
                <td>{{ $license->quantity }}</td>
                <td>
                    <a href="{{ route('license.show', $license->id) }}" class="btn btn-back">View</a>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        
                        <a href="{{ route('license.edit', $license->id) }}" class="btn btn-update">
                            Edit
                        </a>
                        
                        <form action="{{ route('license.destroy', $license->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this license?');">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="button-wrapper">
        <a href="/Menu">
            <button type="button">Back</button>
        </a>
    </div>
</div>
<x-footer />

