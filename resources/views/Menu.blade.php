<!DOCTYPE html>
<html>

    <head>
            <title>GBN Home Page</title>
            <link rel="stylesheet" href="{{ asset('css/MainPage.css') }}">
    </head>

    <body>
        <div class="main-container">
            <h1>Hi. {{ session('name') }}</h1>
        </div>

        @if(Auth::user()->isStaff())
        <div class="main-container">
            <h1>Menu For Staff</h1>
        </div>

        <div class="main-container">
            <div class="button-wrapper">
                <a href='/ProfilePage/{{ session('user_id') }}'>
                    <button>Profile Page</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/it_assets/list'>
                    <button>IT Asset</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/it_asset_maintenance'>
                    <button>IT Asset Maintenance</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href=''> <!--to be changed-->
                    <button>License</button>
                </a>
            </div>
        </div>

        @elseif(Auth::user()->isAdmin())
        <div class="main-container">
            <h1>Menu For Administrator</h1>
        </div>

        <div class="main-container">
            <div class="button-wrapper">
                <a href='/ProfilePage/{{ session("user_id") }}'>
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

        @else
            <div class="main-container">
                <h1>Sorry, this system might have some issues. Please wait the latest new. Thank you for your patience. </h1>
            </div>
        @endif

        <div class="main-container">
            <div class="button-wrapper">
                <a href="/">
                    <button>Log out </button>
                </a>
            </div>
        </div>

        <x-footer />
    </body>
</html>