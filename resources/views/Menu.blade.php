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

        @can('isStaff')
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
                <a href='/it_asset'>
                    <button>IT Asset</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/ViewMaintenanceList'>
                    <button>IT Asset Maintenance</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/license_list'>
                    <button>License</button>
                </a>
            </div>
        </div>

        @elsecan('isAdmin')
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
                <a href='/it_asset'>
                    <button>IT Asset</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/ViewMaintenanceList'>
                    <button>IT Asset Maintenance</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/user_list'>
                    <button>User List</button>
                </a>
            </div>
            <div class="button-wrapper">
                <a href='/license_list'>
                    <button>License</button>
                </a>
            </div>
        </div>

        @else
            <div class="main-container">
                <h1>Sorry, this system might have some issues. Please wait the latest new. Thank you for your patience. </h1>
            </div>
        @endcan

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