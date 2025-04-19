<DOCTYPE! html> 

<html>
    <head>
        <title>GBN</title>
        <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    </head>
    <body>
        <div class="main-container">
            <h1>Welcome to GBN</h1>
        </div>
        <div class="main-container">
            <div>
                <h2>Please choose one of them to login.</h2>
            </div>
            <div class="button-wrapper">
                <a href="/LoginForStaff">
                    <button>
                        Staff Login
                    </button>
                </a>
            </div> 
            <br> 
            <div class="button-wrapper">
                <a href="/LoginForAdmin">
                    <button>
                        Admin Login
                    </button>
                </a>
            </div>    
        </div>
        <x-footer />
    </body>
</html>