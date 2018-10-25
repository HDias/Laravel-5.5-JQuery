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

<body style="height: 100vh;">
<div id="app" class="h-100 login">
    @include('alerts.flashMessage')
    @yield('content')
</div>

{{--<footer class="sticky-footer">--}}
    {{--<div class="container">--}}
        {{--<div class="text-center">--}}
            {{--<small>Copyright © NUT 2018</small>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}

<!-- Scripts -->
<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
