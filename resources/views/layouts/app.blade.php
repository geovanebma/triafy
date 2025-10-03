<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Triafy</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const conteudo = document.getElementById("conteudo");

            document.querySelectorAll(".menu-link").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();
                    let url = this.getAttribute("data-url");

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            conteudo.innerHTML = html;
                        })
                        .catch(err => console.error("Erro ao carregar conteúdo:", err));
                });
            });
        });
    </script>
</body>
</html>