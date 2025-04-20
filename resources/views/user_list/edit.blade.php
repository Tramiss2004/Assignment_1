<head>
    <title>GBN: Edit User Details</title>
    <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}">
</head>

<body>
    <div>
        <h2>Update User (User ID: {{ $user->id }})</h2>

        {{-- Display validation errors if any --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user_list.update',  $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- User Name --}}
            <div class="mb-3">
                <label class="form-label">User Name: </label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
    
                
            {{-- Position --}}
            <div class="mb-3">
                <label class="form-label">Position: </label>
                <select name="position" id="position" class="form-control" required>
                    {{-- Add more options as needed --}}
                    @php $currentPosition = old('position', $user->position); @endphp
                    <option value="Assistant" {{ old('position') == 'Assistant' ? 'selected' : '' }}>Assistant</option>
                    <option value="Coordinator" {{ old('position') == 'Coordinator' ? 'selected' : '' }}>Coordinator</option>
                    <option value="Manager" {{ old('position') == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Executive" {{ old('position') == 'Executive' ? 'selected' : '' }}>Executive</option>
                    <option value="Senior Executive" {{ old('position') == 'Senior Executive' ? 'selected' : '' }}>Senior Executive</option>
                    <option value="Senior Manager" {{ old('position') == 'Senior Manager' ? 'selected' : '' }}>Senior Manager</option>
                    <option value="Director" {{ old('position') == 'Director' ? 'selected' : '' }}>Director</option>
                </select>
            </div>

                
            {{-- Department --}}
            <div class="mb-3">
                <label class="form-label">Department: </label>
                <select name="department" id="department" class="form-control" required>
                    {{-- Add more options as needed --}}
                    @php $currentDepartment = old('department', $user->department); @endphp
                    <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>HR</option>
                    <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Marketing" {{ old('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                    <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                    <option value="Customer Services" {{ old('department') == 'Customer Services' ? 'selected' : '' }}>Customer Services</option>
                </select>
            </div>

            {{-- Is Admin --}}
            <div class="mb-3">
                <label class="form-label">Is Admin: </label>
                <select name="is_admin" id="is_admin" class="form-control">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
                
            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email: </label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password: </label>
                <input type="text" name="password" class="form-control" value="{{ old('password', $user->password) }}" required>
            </div>    

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update User Details</button>
                <a href="{{ route('user_list.index') }}" class="btn btn-secondary">Cancel</a> {{-- Use a different class for Cancel maybe? --}}
            </div>
        </form> 

        <x-footer />
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const isAdmin = document.getElementById("is_admin");
            const department = document.getElementById("department");
            const position = document.getElementById("position");

            function updateIsAdmin(){
                console.log("Department: ", department.value);
                console.log("Position: ", position.value);

                if (department.value == "IT"){
                    if(position.value == "Executive" || position.value == "Senior Executive" || position.value == "Manager" || position.value == "Senior Manager" || position.value == "Director"){
                        isAdmin.value = "Yes";
                    }else{    
                        isAdmin.value = "No";
                    }
                }
                else{
                    isAdmin.value = "No";
                }
            }

            department.addEventListener("change", updateIsAdmin);
            position.addEventListener("change", updateIsAdmin);
        });

    </script>
</body>