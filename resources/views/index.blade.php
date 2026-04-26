<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                background: #f8fafc;
            }

            .welcome-container {
                text-align: center;
                padding: 60px 20px;
            }

            .title {
                font-size: 54px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .subtitle {
                font-size: 20px;
                color: #555;
                margin-bottom: 30px;
            }

            .button-container {
                margin-top: 40px;
                display: flex;
                justify-content: center;
                gap: 20px;
            }

            .btn {
                padding: 12px 28px;
                font-size: 18px;
                border-radius: 8px;
                text-decoration: none;
                color: white;
                transition: 0.2s;
            }

            .btn-admin {
                background: #2563eb;
            }
            .btn-admin:hover {
                background: #1e40af;
            }

            .btn-user {
                background: #16a34a;
            }
            .btn-user:hover {
                background: #15803d;
            }
        </style>
    </head>

    <body>

        <div class="welcome-container">
            <h1 class="title">Welcome to Your Laravel App</h1>
            <p class="subtitle">Build something amazing using Laravel 12.</p>

            {{-- Tombol Login --}}
            <div class="button-container">
                <a href="{{ route('register.show') }}" class="btn btn-admin">Lihat list Admin</a>

                {{-- Dummy User login --}}
                <a href="{{ route('admin.login.show') }}" class="btn btn-user">Login</a>
            </div>
        </div>

    </body>
</html>
