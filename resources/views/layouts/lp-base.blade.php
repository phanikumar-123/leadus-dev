<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Lead Us | Your UPSC practice partner')</title>

    <link href="https://fonts.googleapis.com/css?family=Belgrano:400" rel="stylesheet" type="text/css">
    <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('lp/css/style.css')}}">
</head>

<body>
    <div class="loader d-none">
        <div class="spinner">
            <canvas id="canvas" width="105" height="105">
                <p>Get chrooome!</p>
            </canvas>
        </div>
        <p title="Loading, please wait."></p>
    </div>

    <div class="site-content">
        <div class="site-header header-collapsed">
            <div class="container-fluid">
                <div class="header-bar">
                    <a href="{{ route('main') }}" class="branding">
                        <img src="{{asset('lp/images/logo.png')}}" alt="" class="logo">
                        <h1 class="site-title">Lead Us</h1>
                    </a>

                    <!-- Default snippet for navigation -->
                    <div class="main-navigation">
                        <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                        <div class="menu">
                            <div class="main-menu">
                                <div class="menu-item"><a href="#features">Features</a></div>
                                <div class="menu-item"><a href="#mock-tests">Mock Tests</a></div>
                                <div class="menu-item"><a href="#current-affairs">Current Affairs</a></div>
                                <div class="menu-item"><a href="#subjects">Subjects</a></div>
                                <div class="menu-item"><a href="#contact">Contact</a></div>
                            </div> <!-- .menu -->
                            <div class="login-menu">
                                <div class="menu-item"><a class="login-btn" href="{{ route('login') }}">Sign In</a></div>
                                <div class="menu-item"><a class="register-btn" href="{{ route('register') }}">Sign Up</a></div>
                            </div>
                        </div>
                    </div> <!-- .main-navigation -->

                    <div class="mobile-navigation"></div>

                </div>
            </div>
        </div> <!-- .site-header -->

        @yield('content')
    </div>

    <x-footer />
    <script src="{{ asset('lp/js/app.js') }}"></script>

</body>

</html>
