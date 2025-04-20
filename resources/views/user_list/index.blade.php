<head>
    <title>GBN: User List</title>
    <link rel="stylesheet" href="{{ asset('css/ITAsset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ITAssetList.css') }}">
</head>


<body>
    <div class="container">
        <h2>User List</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('user_list.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search User" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div>
            <a href="{{ route('user_list.create') }}" class="btn btn-info">New User</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('user_list.show', $user->id) }}" class="btn btn-back">
                            View
                        </a>

                        <a href="{{ route('user_list.edit', $user->id) }}" class="btn btn-update">
                            Edit
                        </a>
                    
                        <form action="{{ route('user_list.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        <!-- end if is admin -->
                        </form>
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
</body>