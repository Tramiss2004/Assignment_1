<head>

</head>


<body>
    <div class="container">
        <h2>Create New User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        
        <form action="{{ route('user_list.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Is Admin: </label>
                <select name="assigned_status" id="assigned_status" class="form-control" required onchange="toggleAssignedUser()">
                <option value="Yes" {{ old('is_admin') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('is_admin') == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" name="name" class="form-control" value="{{ old('position') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="name" class="form-control" value="{{ old('department') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="name" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="name" class="form-control" value="{{ old('password') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Create User</button>
        </form>
    </div>
</body>