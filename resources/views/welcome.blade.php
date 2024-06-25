<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Регистрация / Авторизация</h1>

        <!-- Ссылки на страницы входа и регистрации -->
        @guest <!-- Проверка, что пользователь не аутентифицирован -->
            <p>
                <a href="{{ route('login') }}" class="btn btn-custom mr-2">Авторизоваться</a>
                или
                <a href="{{ route('register') }}" class="btn btn-custom ml-2">Регистрация</a>
            </p>
        @else <!-- Если пользователь аутентифицирован, показать имя и ссылку на выход -->
            <p>
                Здравствуйте, {{ Auth::user()->name }}!
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="btn btn-custom ml-2">
                    Выйти
                </a>
                @csrf
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </p>
        @endguest
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>