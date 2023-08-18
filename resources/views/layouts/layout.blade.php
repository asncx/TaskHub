<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>ToDo</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-light">
        <a class="navbar-brand" href="#">To-Do</a>

        <div class="container-fluid">
            <ul class="navbar-nav">
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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" href="{{ route('logout') }}">Logout</button>
                </form>
            @else
                <div class="d-flex">
                    <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                </div>
            @endauth
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
