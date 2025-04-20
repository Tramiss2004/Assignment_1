<head>
    <title>GBN: User Details</title>
    <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}">
</head>

<body>
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
                <td>{{ $user->position }}</td>
            </tr>
            <tr>
                <th>Department:</th>
                <td>{{ $user->department }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Is Admin:</th>
                <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
            </tr>
        
        </table>
        <br>
        <a href="{{ route('user_list.index') }}" class="btn btn-primary">Back to List</a>
    </div>
    <x-footer />
</body>