<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Invoice Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #fff;
        }
        .hero {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }
        .btn-lg {
            min-width: 150px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <a class="navbar-brand mx-3" href="{{ url('/') }}">Invoice Management</a>
    
    </nav>
<div class="container my-5 px-10">
    <div class="hero p-5 text-center">
        <h1 class="text-body-emphasis display-4 py-3">Welcome to Invoice Management System</h1>
        @if (Route::has('login'))
            <div class="d-inline-flex gap-3 mb-5">
                @auth
                    <a href="{{ url('/invoices') }}" class="btn btn-outline-success btn-lg px-4 rounded-pill" type="button">
                        Invoices
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 rounded-pill" type="button">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg px-4 rounded-pill" type="button">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
</body>
</html>
