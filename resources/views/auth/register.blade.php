@extends('layouts.site-base')

@section('body-class', 'user-form-bg')
@section('body')
    <div class="register-container">
        <div class="sign-up user-form slide-top">
            <!-- FORM CAROUSEL STARTS -->
            <div id="form-slider" class="carousel slide" data-interval="false" data-touch="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="form-one">
                            <h1 class="logo">LeadUs</h1>
                            <form id="form-signup" name="sign-up-form" enctype="multipart/form-data" novalidate>
                                <h1 class="mt-3 mb-3 font-weight-normal">New here? Create your account</h1>
                                <div class="sign-up-content">
                                    <div class="form-section">

                                        <div class="form-row">
                                            <div class="col-md-6 col-lg-6 col-xs-12 first-name ">
                                                <input type="text" name="first_name" id="firstName" class="form-control form-field">
                                                <label class="field-label" for="firstName">First name</label>
                                                <span class="name-error d-none fname">Enter first name</span>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 last-name">
                                                <input type="text" name="last_name" id="lastName" class="form-control form-field">
                                                <label class="field-label" for="lastName">Last name</label>
                                                <span class="name-error d-none lname">Enter last name</span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="email-field">
                                                    <input type="email" id="inputEmail" class="form-control form-field" name="email">
                                                    <label class="field-label" for="inputEmail">Email address</label>
                                                    <span class="sign-up-email-error d-none">Kindly add a valid email address</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-1 password-row">
                                            <div class="col password-field">
                                                <input type="password" id="signUpPassword" class="form-control form-field" name="password">
                                                <label class="field-label" for="inputPassword">Password</label>
                                            </div>
                                            <div class="col">
                                                <input type="password" id="confirmPassword" class="form-control form-field mb-4" name="password_confirmation">
                                                <label class="field-label" for="inputConfirmPassword">Confirm Password</label>
                                                {{--<span class="confirm-pwd-error d-none">Passwords didn't match. Try again</span>--}}
                                            </div>
                                            <i class="fa fa-eye-slash password-toggle" aria-hidden="true"></i>
                                            <div class="sign-up-pwd-error d-none">Invalid password.Use 8 characters or more</div>
                                            <div class="confirm-pwd-error d-none">Passwords didn't match. Try again</div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="number" id="sign-up-phone" name="phone" class="form-control form-field">
                                                <label class="field-label"  for="sign-up-phone">Mobile number</label>
                                                <span class="sign-up-phone-error d-none">Enter a valid mobile number of atleast 10 digits.</span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <p class="terms-condition-text"><input type="checkbox" id="termsConditions" class="form-control" name="terms-conditions">
                                                    <span>I agree to the <a href="#">terms of service</a> and <a href="#">privacy policy</a> of LeadUs</span>
                                                </p>
                                                <span class="checkbox-error d-none">You have to check the above checkbox to proceed further</span>
                                            </div>
                                        </div>

                                        <div class="sign-up-btns mt-3">
                                            <div class="sign-up-btn-wrapper mb-2">
                                                <button class="btn btn-lg btn-primary float-right sign-up-btn" type="submit">Lets Go</button>
                                            </div>
                                            <div class="sign-in-link">
                                                <a href="{{ route('login') }}" class="link">Already a User? Sign in instead</a>
                                            </div>
                                        </div>

                                    </div>

                                    <!--CHOOSE AVATAR SECTION-->

                                    <div class="avatar-section">
                                        <div class="profile-cirle upload-button">
                                            <img class="profile-pic" src="{{ asset('site/images/profile-placeholder.png') }}" alt="profile-picture" />
                                            <div class="profile-pic-overlay d-none">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>

                                        <p class="mt-2">Upload Profile Picture</p>

                                        <div class="p-image">
                                            <!-- <i class="fa fa-camera"></i> -->
                                            <input class="file-upload" type="file" name="profile_photo" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="form-two">
                            <h1 class="logo">LeadUs</h1>
                            <form id="otp-form" name="otp-form" enctype="multipart/form-data" novalidate>
                                <h1 class="title text-center mt-4">Verify your Email Address</h1>
                                <h2 class="mt-4 mb-3 font-weight-normal sub-title">We have sent you a email at <span id="email-id"></span> with an OTP. Please enter it below to verify your email address.</h2>
                                <div class="sign-up-content">
                                    <div class="otp-group mt-3">
                                        <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                                        <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                                        <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                                        <input type="text" id="digit-4" name="digit-4"  data-previous="digit-3" />
                                    </div>
                                    <div class="w-100 mt-3 otp-timer-wrapper">
                                        <p class="timer text-center">Resend OTP in <span id="otp-resend-timer" data-timer-start="{{ $otp_time }}">00:30</span></p>
                                        <a class="text-center w-100 resend-link d-none" href="javascript:void(0)">Resend OTP</a>
                                    </div>
                                    <div class="sign-up-btns mt-4 w-100 align-items-center">
                                        <div class="sign-up-btn-wrapper mb-2">
                                            <div>
                                            <button class="btn btn-lg btn-primary float-right back-btn" type="submit">Back</button>
                                            </div>
                                            <div>
                                            <button class="btn btn-lg btn-primary float-right sign-up-btn" id="otp-btn" type="submit" disabled>Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORM CAROUSEL ENDS -->
        </div>
    </div>
@endsection
