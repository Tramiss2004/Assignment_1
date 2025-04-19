<!DOCTYPE html> 
<html>
<<<<<<< HEAD
    <head>
        <title>GBN</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div>
            <h1>Login (Staff Section)</h1>
        </div>
        <div>
            <form action="login" method="POST">
                @csrf
                <div>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="username" name="username"></input><br>
                    <span style ="color: red;">
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
                    <br>
                </div>

                <div>
                    <label for="password">Password:</label>
                    <br>
                    <input type="password" id="password" name="password"></input><br>
                    <span style ="color: red;">
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
                    <br>
                </div>

                <div>
                    <input type="hidden" name="is_admin" value="0"></input>
                    <br>
                </div>

                <div>
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
        <x-footer />
    </body>
</html>
=======
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
>>>>>>> JH_20250419_1
