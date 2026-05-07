<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>

    <body class="welcome-body">
        <div class="welcome">
            @if (Route::has('login'))

                <div class="welcome__nav">
                    @auth

                        <a href="{{ url('/home') }}">
                            Home
                        </a>

                    @else

                        <a href="{{ route('login') }}">
                            Log in
                        </a>

                        @if (Route::has('register'))

                            <a href="{{ route('register') }}">
                                Register
                            </a>

                        @endif
                    @endauth
                </div>

            @endif

            <div class="welcome__content">
                <h1>
                    Laravel
                </h1>

                <p>
                    自販機管理アプリへようこそ
                </p>
            </div>
        </div>
    </body>
</html>