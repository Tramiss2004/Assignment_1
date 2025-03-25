<!DOCTYPE html> 
<html>
    <head>
        <title>GBN</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div>
            <h1>Login (Staff Section)</h1>
        </div>
        <div>
            <form>
                <div>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="username" name="username"></input><br>
                    <span>
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
                    <span>
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
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