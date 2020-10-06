@extends('layouts.site-base')

@section('body-class', 'user-form-bg')
@section('body')
<div class="register-container">
    <div class="sign-up user-form slide-top">
        <!-- FORM CAROUSEL STARTS -->
        <div id="form-slider" class="carousel slide" data-interval="false" data-touch="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="form-two">
                        <h1 class="logo">LeadUs</h1>
                        <form id="otp-form" name="otp-form" enctype="multipart/form-data" novalidate>
                            <h1 class="title text-center mt-4">Verify your Email Address</h1>
                            <h2 class="mt-4 mb-3 font-weight-normal sub-title">We have sent you a email at <span id="email-id">{{ $mail_id }}</span>
                                with an OTP. Please enter it below to verify your email address.</h2>
                            <div class="sign-up-content">
                                <div class="otp-group mt-3">
                                    <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                                    <input type="text" id="digit-2" name="digit-2" data-next="digit-3"
                                        data-previous="digit-1" />
                                    <input type="text" id="digit-3" name="digit-3" data-next="digit-4"
                                        data-previous="digit-2" />
                                    <input type="text" id="digit-4" name="digit-4" data-previous="digit-3" />
                                </div>
                                <div class="w-100 mt-3 otp-timer-wrapper">
                                    <p class="timer text-center">Resend OTP in <span id="otp-resend-timer"
                                            data-timer-start="{{ $otp_time }}">00:30</span></p>
                                    <a class="text-center w-100 resend-link d-none" href="javascript:void(0)">Resend
                                        OTP</a>
                                </div>
                                <div class="sign-up-btns mt-4 w-100 align-items-center">
                                    <div class="sign-up-btn-wrapper mb-2">
                                        <div>
                                            <button class="btn btn-lg btn-primary float-right sign-up-btn" id="otp-btn"
                                                type="submit" disabled>Confirm</button>
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
