<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head>
    <title>GBN: Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>
<body>
    <div class="login-container">
        <h1>Login (Admin Section)</h1>
        <form action="" method="POST">
            @csrf
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <span>@error('username') {{ $message }} @enderror</span>
            </div>
            <br>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span>@error('password') {{ $message }} @enderror</span>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <x-footer />
</body>
</html>
=======
    <head>
        <title>GBN: Admin Login</title>
    </head>
    <body>
        <div>
            <h1>Login (Admin Section)</h1>
        </div>
        <div>
            <form action="" method="POST">
                <div>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="username" name="username" placeholder="Enter Username"></input><br>
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
                    <input type="hidden" name="is_admin" value="1"></input>
                    <br>
                </div>

                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
        <x-footer />
    </body>
</html>
>>>>>>> JH_20250416_2
