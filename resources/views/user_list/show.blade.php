<div class="container">
    <h2>User Details</h2>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Position:</th>
            <td>{{ $user->Position }}</td>
        </tr>
        <tr>
            <th>Department:</th>
            <td>{{ $user->Department }}</td>
        </tr>
    </table>
    <a href="{{ route('user_list.index') }}" class="btn btn-primary">Back to List</a>
</div>
<x-footer />