<div class="container">
    <h2>Create New IT Asset</h2>

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
            <label class="form-label>
</div>