<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        {{-- BRAND --}}
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Admin Souvenir
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.souvenirs.*') ? 'active' : '' }}"
                       href="{{ route('admin.souvenirs.index') }}">
                        Souvenir
                    </a>
                </li>

                {{-- KATEGORI --}}

            </ul>

            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
