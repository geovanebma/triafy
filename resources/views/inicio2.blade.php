<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Triafy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="principal">
    <nav class="" id="menu-nav">
        <div class="row w-100">
            <div class="col-3 col-sm-3 col-md-3 col-xs-3">
                <a href="{{ route('login') }}" class="btn">
                    <img id="logo-principal" src="{{ asset('logo.jpeg') }}" alt="">
                </a>
            </div>
            <div class="col-3 col-sm-9 col-md-9 col-xs-9">
                <div id="botoes-div">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="btn inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            dashboard
                        </a>
                    @else
                        <a id="login_btn" href="{{ route('login') }}" class="btn">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a id="registro_btn" href="{{ route('register') }}" class="btn">
                                Registre-se
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <div class="min-h-screen flex items-center justify-center" id="div-dashboard">
        @if (Route::has('login'))
        @endif
        <div class="text-center">
            <h1 class="">Transforme sua logística com agilidade e controle</h1>
            <p>Triafy conecta seus fornecedores e revendedores com mais organização, rastreabilidade e facilidade.
                Automatize etiquetas, envios e tenha tudo sob controle.</p>

            <!-- <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white font-semibold transition">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-100 text-gray-900 hover:bg-white rounded-lg font-semibold transition">
                        Criar conta
                    </a>
                </div> -->

            <p class="mt-10 text-sm text-gray-400">
                Já automatizamos centenas de envios. Chegou a sua vez.
            </p>
        </div>
    </div>
</body>

</html>