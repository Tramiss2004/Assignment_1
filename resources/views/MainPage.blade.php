<DOCTYPE! html>

<html>
    <head>
        <title>GBN</title>
        <link rel="stylesheet" href="{{ asset('css/MainPage.css') }}">
    </head>

    <div class="main-container">
        <h1>Welcome to GBN</h1>

        <h2>Please choose login method.</h2>

        <div class="button-wrapper">
            <a href="/LoginForStaff">
                <button>Staff Login</button>
            </a>
        </div>

        <div class="button-wrapper">
            <a href="/LoginForAdmin">
                <button>Admin Login</button>
            </a>
        </div>
    </div>

    <x-footer />

</body>

</html>
