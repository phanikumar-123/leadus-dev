<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LeadUs') }}</title>

    <!-- Styles -->
    <link href="{{ asset('site/css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('body-class', '')">
    <div class="loader d-none">
        <div class="spinner">
            <canvas id="canvas" width="105" height="105">
                <p>Get chrooome!</p>
            </canvas>
        </div>
        <p title="Loading, please wait."></p>
    </div>
    @yield('body')

    <!-- Scripts -->
    <script src="{{ asset('site/js/app.js') }}"></script>

    @yield('footer-scripts')
</body>
</html>
