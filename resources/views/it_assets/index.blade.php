<div class="container">
    <h2>IT Asset List</h2>
    <table class="table table-bordered"> <!-- Added Bootstrap border -->
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
                <td>{{ $asset->purchase_date }}</td>
                <td>
                    <a href="{{ route('it_assets.show', $asset->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('it_assets.edit', $asset->id) }}" class="btn btn-warning">Edit</a>
                   
                    <form action="{{ route('it_assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this asset?');">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('it_assets.create') }}" class="btn btn-primary mb-3">New IT Asset</a>

    <style>
    table, th, td {
        border: 1px solid black;
    }
</style>
</div>
