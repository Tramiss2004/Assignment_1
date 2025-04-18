<!DOCTYPE html>
<html>

    <head>
            <title>GBN</title>
            <link rel="stylesheet" href="{{ asset('css/MainPage.css') }}">
    </head>

    <body>
        <div class="main-container">
            <h1>Menu For Administrator</h1>
        </div>

        <div class="main-container">
            <div class="button-wrapper">
                <a href='/ProfilePage/{id}'>
                    <button>Profile Page</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/it_assets/list'>
                    <button>IT Asset</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href=''><!--show the list-->
                    <button>IT Asset Maintenance</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href=''><!--to be changed-->
                    <button>User List</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href=''>
                    <button>License</button>
                </a>
            </div>
        </div>

        <div class="button-wrapper">
            <a href="/">
                <button>Log out</button>
            </a>
        </div>

        <x-footer />
    </body>
</html>