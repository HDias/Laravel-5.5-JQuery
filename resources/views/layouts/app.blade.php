<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('style')
</head>
<body class="fixed-nav sticky-footer bg-blue" id="page-top">
{{--@include('layouts.nav.nav')--}}
<div id="app" class="content-wrapper">
    <div class="container-fluid theme-sna">

        @include('alerts.flashMessage')
        @yield('content')
    </div>
</div>
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © NUT 2018</small>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
