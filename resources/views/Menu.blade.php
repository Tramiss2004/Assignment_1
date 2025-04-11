<div>
    <h1>Welcome to GBN, {{ session('user') }}</h1>
</div>

@can ('isStaff')
<div>
    <h1>Menu For Staff</h1>
</div>

<div>
    <div>
        <a href='/ProfilePage/{id}'>
            <button>Profile Page</button>
        </a>
    </div>
    <div>
        <a href='/it_asset/list'> <!--to be changed-->
            <button>IT Asset</button>
        </a>
    </div>
    <div>
        <a href='/it_asset_maintenance'> <!--to be changed-->
            <button>IT Asset Maintenance</button>
        </a>
    </div>
    <div>
        <a href=''> <!--to be changed-->
            <button>License</button>
        </a>
    </div>
</div>


@elsecan ('isAdmin')
<div>
    <h1>Menu For Administrator</h1>
</div>

<div>
    <div>
        <a href='/ProfilePage/{id}'>
            <button>Profile Page</button>
        </a>
    </div>
    <div>
        <a href='/it_asset'>
            <button>IT Asset</button>
        </a>
    </div>
    <div>
        <a href=''><!--to be changed-->
            <button>IT Asset Maintenance</button>
        </a>
    </div>
    <div>
        <a href=''><!--to be changed-->
            <button>User List</button>
        </a>
    </div>
    <div>
        <a href=''>
            <button>License</button>
        </a>
    </div>
</div>
@else
    <div>
        <h1>Sorry, you can't access in this system. </h1>
    </div>
@endcan

<div>
    <a href="/">
        <button>Log out </button>
    </a>
</div>

<x-footer />