<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Landing Page')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- BOOTSTRAP CDN (CSS) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CUSTOM CSS --}}
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

    @stack('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

@include('layouts.landing-page.header')

<main id="main">
    @yield('content')
</main>

@include('layouts.landing-page.footer')

{{-- BOOTSTRAP CDN (JS) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- CUSTOM JS --}}
<script src="{{ asset('resources/js/app.js') }}"></script>

@stack('js')
</body>
</html>
