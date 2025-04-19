<!DOCTYPE html> 
<html>
<head>
    <title>GBN</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Login (Staff Section)</h1>
        <form action="{{ url('LoginForStaff') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username">
                <span>@error('username') {{ $message }} @enderror</span>
            </div>
            <br>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password">
                <span>@error('password') {{ $message }} @enderror</span>
            </div>

            <div>
                <input type="hidden" name="is_admin" value="0"></input>
                <br>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
    <x-footer />
</body>
</html>
