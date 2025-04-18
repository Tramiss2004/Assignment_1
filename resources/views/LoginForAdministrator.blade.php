<!DOCTYPE html>
<html>
    <head>
        <title>GBN: Admin Login</title>
        <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    </head>
    <body>
        <div class="login-container">
            <h1>Login (Admin Section)</h1>
            <div>
                <form action="{{ url('LoginForAdmin') }}" method="POST">
                    @csrf
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
                        <input type="password" id="password" name="password" placeholder="Enter Password"></input><br>
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
        </div>
        <x-footer />
    </body>
</html>
