<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Панель управления')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: bold;
            color: #4e73df !important;
        }

        .logout-btn {
            border: none;
            background: none;
            color: #dc3545;
            font-weight: 500;
        }

        .logout-btn:hover {
            text-decoration: underline;
        }

        .content-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            AVN КГТУ
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item d-flex align-items-center">
                        <span class="me-3 text-muted">
                            Добро пожаловать
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="logout-btn" type="submit">
                                Выйти
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="content-card">
        @yield('content')
    </div>
</div>

<footer>
    © {{ date('Y') }} AVN Образовательный портал КГТУ
</footer>

</body>
</html>