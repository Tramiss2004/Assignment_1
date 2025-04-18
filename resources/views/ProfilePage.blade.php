<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="profile-container">
        <h1 class="profile-title">Profile Page for {{ $data->id }}</h1>

        <div class="profile-info">
            <p><strong>ID:</strong> {{ $data->id }}</p>
            <p><strong>Name:</strong> {{ $data->name }}</p>
            <p><strong>Email:</strong> {{ $data->email }}</p>
        </div>

        <div class="button-wrapper">
            <a href="/Menu">
                <button>Back</button>
            </a>
        </div>

        
    </div>
    <x-footer />
</body>
</html>
