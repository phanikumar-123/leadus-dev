@extends('layouts.site-base')

@section('body-class', 'user-form-bg')

@section('body')
    <div class="login-container">
        <div class="login user-form slide-top">
           {{-- <div class="border-corner one"></div>
            <div class="border-corner two"></div>
            <div class="border-corner three"></div>
            <div class="border-corner four"></div>--}}
            <h1 class="logo">LeadUs</h1>
            <h1 class="mt-3 mb-4 font-weight-normal">Sign in to your Account</h1>
            <form id="form-signin" name="sign-in-form" novalidate >
                <div class="email-field">
                    <input type="email" id="inputEmail" class="form-control form-field" name="email" autocomplete="off">
                    <label class="field-label" for="inputEmail">Email address</label>
                    <span class="email-error d-none">Kindly add a valid email</span>
                </div>
                <div class="password-field">
                    <input type="password" id="inputPassword" class="form-control form-field mb-4" name="password" autocomplete="off">
                    <label class="field-label" for="inputPassword">Password</label>
                    <span class="pwd-error d-none">Invalid password.Try again or click Forgot password to  reset</span>
                    <i class="fa fa-eye-slash password-toggle" aria-hidden="true"></i>
                </div>
                <div class="forgot-password">
                    <a href="#" class="link">Forgot Password?</a>
                </div>
                <div class="remember-me-check">
                    <input type="checkbox" id="remember-check" name="remember" value="true">
                    <label class="form-check-label" for="remember-check">Stay Signed in</label>
                </div>
                <div class="submit-btn-wrapper mt-2">
                    <button class="btn btn-lg btn-primary float-right sign-in-btn" type="submit">Sign In</button>
                </div>
                <p class="mt-5 mb-3 sign-up-link"> <a href="{{route('register')}}" class="link">Not a user yet? Sign up </a></p>
            </form>
        </div>
    </div>
@endsection
