<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpeg') }}">

    <title>Triafy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <!-- <nav class="" id="menu-nav">
            <div class="row w-100">
                <div class="col-3 col-sm-3 col-md-3 col-xs-3">
                    <a href="{{ route('login') }}" class="btn">
                        <img id="logo-principal" src="{{ asset('logo.jpeg') }}" alt="">
                    </a>
                </div>
            </div>
        </nav> -->
    {{ $slot }}
</body>

</html>