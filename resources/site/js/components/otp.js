$(document).ready(function () {
    let $timer = $('.timer');
    let $otpResendTimer = $timer.find('#otp-resend-timer');
    let startTime = $otpResendTimer.data('timerStart');
    let $resendLink = $('.otp-timer-wrapper .resend-link');
    let $formSlider = $('#form-slider');

    window.otpInit = function () {
        //$('#form-slider').carousel(1);
        var initalizeTimer = function(resolve, reject) {
            if ($otpResendTimer.length && typeof startTime === 'number') {
                let time = (new Date().getTime() + (startTime * 1000));
                let now = new Date().getTime();
                let distance = time - now;
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                printOtpResendTime(minutes, seconds);

                $.post('/sendOtp').done(function (resp) {
                    let id = setInterval(timer, 1000);

                    function timer() {
                        distance -= 1000;
                        if (distance === 0) {
                            clearInterval(id);
                            $resendLink.removeClass('d-none');
                            $timer.addClass('d-none');
                        } else {
                            minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            printOtpResendTime(minutes, seconds);
                        }
                    }
                    resolve(resp);
                }).fail(function () {
                    reject('Call to send OTP failed!!');
                });
            } else {
                reject('Otp timer markup not properly created!!');
            }
        }
        return new Promise(initalizeTimer);
    }

    function printOtpResendTime(minutes, seconds) {
        let time = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
        $otpResendTimer.text(time);
    }

    if (location.href.endsWith('/otp')) {
        otpInit();
    }

    $resendLink.click(function (e) {
        e.preventDefault();
        $resendLink.addClass('d-none');
        $timer.removeClass('d-none');
        /****************************************************
         * Call to resend OTP here
         ***************************************************/
        otpInit();
    });

    $('.otp-group').find('input').each(function () {
        let $this = $(this);
        $this.attr('maxlength', 1);
        $this.on('keyup', function (e) {
            let parent = $($this.parent());

            if (e.keyCode === 8 || e.keyCode === 37) {
                let prev = parent.find('input#' + $this.data('previous'));

                if (prev.length) {
                    $(prev).select();
                }
            } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                let next = parent.find('input#' + $this.data('next'));

                if (next.length) {
                    $(next).select();
                } else {
                    if (parent.data('autosubmit')) {
                        parent.submit();
                    }
                }
            }

            if ($this.is(':last-child')) {
                $('#otp-btn').attr('disabled', false);
            } else {
                $('#otp-btn').attr('disabled', true);
            }
        });
    });

    $('#otp-form .back-btn').click(function (e) {
        e.preventDefault();
        $formSlider.carousel(0);
    });

    $('#otp-form').submit(function (e) {
        e.preventDefault();
        /****************************************************
         * Call to validate OTP here
         ***************************************************/
        let $otpFields = $(this).find('.otp-group  input'),
            otp = '';

        $otpFields.each(function () {
            otp += $(this).val();
        })

        $.ajax({
            url: "/validate-otp",
            type: "POST",
            data: {
                otp: otp
            },
            cache: false,
            beforeSend: function() {
                showLoader();
            },
            success: function (res) {
                if (res.status) {
                    location.href = '/plans';
                } else {
                    alert('Invalid OTP!!');
                }
            },
            error: function () {
                console.error('Call to validate otp failed');
            },
            complete: function() {
                hideLoader();
            }
        });
    });

});
