<div class="container">
    <h2>License Details</h2>

    <p>Showing license with ID: {{ $license->id }}</p>
    <table class="table">
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
    <a href="{{ route('license.index') }}" class="btn btn-primary">Back to List</a>
</div>
<x-footer />
