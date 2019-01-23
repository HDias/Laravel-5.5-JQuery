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
<body>
<header>
    @include('layouts.nav.nav')
</header>

<!-- Begin page content -->
<main role="main" class="container-fluid m-vh-80">
<!-- <div class="container-fluid theme-sna"> -->
    {{ Breadcrumbs::render() }}

    @include('alerts.flashMessage')
    @yield('content')
</main>

@include('layouts.footer')

<!-- Scripts -->
<script src="{{ asset('/js/app.js') }}"></script>
@yield('script')
</body>
</html>
