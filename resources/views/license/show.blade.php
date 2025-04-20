<div class="container">
    <h2>IT Asset Details</h2>
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
            <th>Assigned Status:</th>
            <td>{{ $license->assigned_status }}</td>
        </tr>
        <tr>
            <th>Purchase Date:</th>
            <td>{{ $license->purchase_date }}</td>
        </tr>
    </table>
    <a href="{{ route('license.index') }}" class="btn btn-primary">Back to List</a>
</div>
<x-footer />
    <!-- resources/views/license/show.blade.php -->
    <h1>License Details</h1>
    <p>Showing license with ID: {{ $id }}</p>