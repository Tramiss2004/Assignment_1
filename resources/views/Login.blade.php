<!DOCTYPE html> 
<html>
<head>
    <title>GBN</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="{{ url('') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username:</label><br>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    placeholder="Enter Username" 
                    value="{{ old('username', Cookie::get('remembered_username')) }}">
                <br>
                <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                <br>
            </div>

            <div>
                <label for="password">Password:</label><br>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter Password" 
                    required>
                <br>
                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                <br>
            </div>

            <div class="form-check">
                <input 
                    type="checkbox" 
                    name="remember_username" 
                    id="remember_username" 
                    class="form-check-input"
                    {{ Cookie::get('remembered_username') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember_username">
                    Remember Username
                </label>
            </div>

            <input type="hidden" name="is_admin" value="0">

            <br>
            <button type="submit">Login</button>
        </form>
    </div>
    <x-footer />
</body>
</html>
