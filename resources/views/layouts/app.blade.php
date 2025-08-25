<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Your CSS --}}
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">
</head>
<body>
    {{-- Optional: your navbar/header goes here --}}

    <main class="py-4">
        @yield('content') {{-- IMPORTANT: no $slot here --}}
    </main>

    {{-- Your JS --}}
    <script src="{{ asset('client/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('client/js/popper.min.js') }}"></script>
    <script src="{{ asset('client/js/bootstrap.js') }}"></script>
    <script src="{{ asset('client/js/custom.js') }}"></script>
</body>
</html>
