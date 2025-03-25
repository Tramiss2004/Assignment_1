<!DOCTYPE html>
<html>
    <head>
        <title>GBN: Admin Login</title>
    </head>
    <body>
        <div>
            <h1>Login (Admin Section)</h1>
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
                <button type="submit">Submit</button>
            </form>
        </div>
        <x-footer />
    </body>
</html>