<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    @stack('css')
    <!-- Fonts -->

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
            @include('layouts/sidebar')
            @yield('content')
            @include('layouts/footer')
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}"></script>
            @stack('js')
</body>
</html>
