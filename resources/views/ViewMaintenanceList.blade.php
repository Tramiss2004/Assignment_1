<h1> This is a list of IT assets maintenance details</h1>

<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
    </head>
<div class="container">

    <table border="1" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>IT Asset ID</th>
                <th>Status</th>
                <th>Maintenance Cost</th>
                <th>Maintenance Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenanceListData as $datas)
            <tr>
                <td>{{ $datas->id }}</td>
                <td>{{ $datas->title }}</td>
                <td>{{ $datas->description }}</td>
                <td>{{ $datas->it_asset_id }}</td>
                <td>{{ $datas->status }}</td>
                <td>{{ $datas->maintenance_cost ?? 'N/A' }}</td>
                <td>{{ $datas->maintenance_type }}</td>
                <td>
                <a href="{{ route('it_asset_maintenance.show', $datas->id) }}" class="btn btn-back">View</a>




                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<x-footer />
