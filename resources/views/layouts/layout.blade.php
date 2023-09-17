<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>TaskHub</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">TaskHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('settings') }}">Settings</a>
                        </li>
                        @if (auth()->user()->permission === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.main') }}">Admin</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <div class="d-flex">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" href="{{ route('logout') }}">Logout</button>
                    </div>
                    </form>
                @else
                    <div class="d-flex">
                        <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')

</body>

<footer class="bg-light text-center text-lg-start fixed-bottom">
    <div class="text-center p-3" style="background-color: eee">
        © 2023
    </div>
</footer>

</html>
