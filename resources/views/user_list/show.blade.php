<div class="container">
    <h2>IT Asset Details</h2>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $itAsset->id }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $itAsset->name }}</td>
        </tr>
        <tr>
            <th>Assigned Status:</th>
            <td>{{ $itAsset->assigned_status }}</td>
        </tr>
        <tr>
            <th>Purchase Date:</th>
            <td>{{ $itAsset->purchase_date }}</td>
        </tr>
    </table>
    <a href="{{ route('it_assets.index') }}" class="btn btn-primary">Back to List</a>
</div>
<x-footer />