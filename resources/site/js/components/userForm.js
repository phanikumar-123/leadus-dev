$(document).ready(function () {

    var $emailForm = $('#form-signin'),
        $updatePasswordForm = $('#change-password-form'),
        $inputFields = $('.user-form').find('input[type="email"], input[type="password"], input[type="text"], input[type="number"]'),
        $createPassInput = $('.create-pass').find('input'),
        $changePassInput = $('.change-pass').find('input'),
        $emailField = $emailForm.find('input[type="email"]'),
        $passwordField = $emailForm.find('input[type="password"]'),
        $createPass = $('#create-password-form').find('input[name="password-field"]'),
        $createPassword = $('#create-password-form').find('input[name="confirm-password"]'),
        $confirmNewPassword = $updatePasswordForm.find('input[name=confirm-new-password]');

    /*Email validation*/
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $emailForm.submit(function (e) {
        e.preventDefault();
        var email = $emailField.val();
        if (validateEmail(email)) {
            $emailField.removeClass("invalid").addClass("valid");
            $('.email-error').addClass('d-none');
        } else {
            $emailField.removeClass("valid").addClass("invalid");
            $('.email-error').removeClass('d-none');
        }

        var pwd = $passwordField.val();
        if (validatePassword(pwd)) {
            $passwordField.removeClass("invalid").addClass("valid");
            $('.pwd-error').addClass('d-none');
        } else {
            $passwordField.removeClass("valid").addClass("invalid");
            $('.pwd-error').removeClass('d-none');
        }

        $.post('/login', $(this).serializeObject())
            .done(function (resp) {
                if (resp.status) {
                    location.href = resp.redirect;
                } else {
                    $.toaster({
                        message : 'Invalid EmailId/Password',
                        title : 'Login Failed',
                        priority : 'danger',
                        settings: {
                            'timeout': 5000
                        }
                    });
                }
            }).fail(function () {
            console.error('Login call failed');
        });
    });

    $('#create-password-form').submit(function (e) {
        e.preventDefault();
        var pwd = $createPass.val();
        if (validatePassword(pwd)) {
            $createPass.removeClass("invalid").addClass("valid");
            $('.create-pwd-error').addClass('d-none');
        } else {
            $createPass.removeClass("valid").addClass("invalid");
            $('.create-pwd-error').removeClass('d-none');
            return false;
        }

        if ($createPass.val() !== $createPassword.val()) {
            $createPassword.removeClass("valid").addClass("invalid");
            $('.create-confirm-pwd-error').removeClass('d-none');
            return false;
        } else {
            $createPassword.addClass("valid").removeClass("invalid");
            $('.create-confirm-pwd-error').addClass('d-none');
        }

        $('.create-pass .forgot-password-container').addClass('d-none');
        $('.create-password-success').removeClass('d-none');
    });

    /*Input fields animation*/

    $inputFields.focus(function () {
        $(this).closest('div').find('label').addClass('transform-label');
    });

    $inputFields.focusout(function () {
        if ($(this).val() === "") {
            $(this).closest('div').find('label').removeClass('transform-label');
        }
    });

    /*Create password form*/
    $createPassInput.focus(function () {
        $(this).closest('div').find('label').addClass('transform-label');
    });

    $createPassInput.focusout(function () {
        if ($(this).val() === "") {
            $(this).closest('div').find('label').removeClass('transform-label');
        }
    });

    /*Change password form*/
    $changePassInput.focus(function () {
        $(this).closest('div').find('label').addClass('transform-label');
    });

    $changePassInput.focusout(function () {
        if ($(this).val() === "") {
            $(this).closest('div').find('label').removeClass('transform-label');
        }
    });

    /*Password validation*/
    function validatePassword(pwd) {
        if (pwd.length >= 8) {
            return true;
        } else {
            return false;
        }
    }

    $('.password-toggle').on('click', function () {
        $(this).toggleClass('fa-eye fa-eye-slash');
        if ($passwordField.attr('type') === 'password') {
            $passwordField.attr("type", "text");
        } else {
            $passwordField.attr("type", "password");
        }

        if ($inputPassword.attr('type') === 'password' && $confirmPassword.attr('type') === 'password') {
            $inputPassword.attr("type", "text");
            $confirmPassword.attr("type", "text");
        } else {
            $inputPassword.attr("type", "password");
            $confirmPassword.attr("type", "password");
        }

        if ($createPassword.attr('type') === 'password') {
            $createPassword.attr('type', 'text');
        } else {
            $createPassword.attr('type', 'password');
        }

        if ($confirmNewPassword.attr('type') === 'password') {
            $confirmNewPassword.attr('type', 'text');
        } else {
            $confirmNewPassword.attr('type', 'password');
        }
    });


    /*Sign up form*/
    let $signUpForm = $('#form-signup'),
        $firstName = $('input[name="first_name"]'),
        $lastName = $('input[name="last_name"]'),
        $signUpEmail = $signUpForm.find('input[type="email"]'),
        $inputPassword = $signUpForm.find('#signUpPassword'),
        $confirmPassword = $signUpForm.find('#confirmPassword'),
        $signUpPhoneField = $signUpForm.find('input[type="number"]'),
        $termsCheckBox = $signUpForm.find('#termsConditions');

    $signUpForm.submit(function (e) {
        e.preventDefault();
        let hasError = false;

        if ($firstName.val() === "") {
            $firstName.removeClass("valid").addClass("invalid");
            $('.fname').removeClass('d-none');
            hasError = true;
        } else {
            $firstName.addClass("valid").removeClass("invalid");
            $('.fname').addClass('d-none');
        }

        if ($lastName.val() === "") {
            $lastName.removeClass("valid").addClass("invalid");
            $('.lname').removeClass('d-none');
            hasError = true;
        } else {
            $lastName.addClass("valid").removeClass("invalid");
            $('.lname').addClass('d-none');
        }

        var email = $signUpEmail.val();
        if (validateEmail(email)) {
            $signUpEmail.removeClass("invalid").addClass("valid");
            $('.sign-up-email-error').addClass('d-none');
        } else {
            $signUpEmail.removeClass("valid").addClass("invalid");
            $('.sign-up-email-error').removeClass('d-none');
            hasError = true;
        }

        var pwd = $inputPassword.val();
        if (validatePassword(pwd)) {
            $inputPassword.removeClass("invalid").addClass("valid");
            $('.sign-up-pwd-error').addClass('d-none');
        } else {
            $inputPassword.removeClass("valid").addClass("invalid");
            $('.sign-up-pwd-error').removeClass('d-none');
            hasError = true;
        }

        if ($inputPassword.val() !== $confirmPassword.val()) {
            $confirmPassword.removeClass("valid").addClass("invalid");
            $('.confirm-pwd-error').removeClass('d-none');
            hasError = true;
        } else {
            $confirmPassword.addClass("valid").removeClass("invalid");
            $('.confirm-pwd-error').addClass('d-none');
        }

        if ($signUpPhoneField.val() === "" || $signUpPhoneField.val().length !== 10) {
            $signUpPhoneField.removeClass("valid").addClass("invalid");
            $('.sign-up-phone-error').removeClass('d-none');
            hasError = true;
        } else {
            $signUpPhoneField.addClass("valid").removeClass("invalid");
            $('.sign-up-phone-error').addClass('d-none');
        }

        if ($termsCheckBox.prop('checked')) {
            $('.checkbox-error').addClass('d-none');
        } else {
            $('.checkbox-error').removeClass('d-none');
            hasError = true;
        }

        if (!hasError) {
            $.ajax({
                url: "/register",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                  showLoader();
                },
                success: function(res) {
                    otpInit().then(function(resp) {
                        $('#email-id').text(resp['mail_id'])
                        $('#form-slider').carousel(1);
                        hideLoader();
                    }).catch(function(e) {
                        console.error(e);
                        hideLoader();
                    });
                },
                error: function(e) {
                    console.error('Unable to register the user!!');
                    hideLoader();
                }
            });
        }
    });

    /*Update Profile Form*/
    var $updateProfileForm = $('#update-profile'),
        $updateFirstName = $('input[name="update-first-name"]'),
        $updateLastName = $('input[name="update-last-name"]'),
        $phoneField = $('#update-profile').find('input[type="number"]');

    $updateProfileForm.on('submit', function (e) {
        e.preventDefault();

        if ($updateFirstName.val() === "") {
            $updateFirstName.removeClass("valid").addClass("invalid");
            $('.updatefname').removeClass('d-none');
        } else {
            $updateFirstName.addClass("valid").removeClass("invalid");
            $('.updatefname').addClass('d-none');
        }

        if ($updateLastName.val() === "") {
            $updateLastName.removeClass("valid").addClass("invalid");
            $('.updatelname').removeClass('d-none');
        } else {
            $updateLastName.addClass("valid").removeClass("invalid");
            $('.updatelname').addClass('d-none');
        }

        if ($phoneField.val() === "" || $phoneField.val().length !== 10) {
            $phoneField.removeClass("valid").addClass("invalid");
            $('.phone-error').removeClass('d-none');
            return false;
        } else {
            $phoneField.addClass("valid").removeClass("invalid");
            $('.phone-error').addClass('d-none');
        }
    });


    /*Update password form*/
    var $oldPassword = $updatePasswordForm.find('input[name=old-password-field]'),
        $newPassword = $updatePasswordForm.find('input[name=new-password]'),
        $newPasswordError = $updatePasswordForm.find('.new-pwd-error'),
        $confirmNewPasswordError = $updatePasswordForm.find('.confirm-new-pwd-error');
    $oldPasswordError = $updatePasswordForm.find('.old-pwd-error');

    $updatePasswordForm.submit(function (e) {
        e.preventDefault();
        var oldPwd = $oldPassword.val();
        if (oldPwd === "") {
            $oldPassword.removeClass("valid").addClass("invalid");
            $oldPasswordError.removeClass('d-none');
        } else {
            $oldPassword.addClass("valid").removeClass("invalid");
            $oldPasswordError.addClass('d-none');
        }

        var newPwd = $newPassword.val();
        if (validatePassword(newPwd)) {
            $newPassword.removeClass("invalid").addClass("valid");
            $newPasswordError.addClass('d-none');
        } else {
            $newPassword.addClass("invalid").removeClass("valid");
            $newPasswordError.removeClass('d-none');
            return false;
        }

        if ($newPassword.val() !== $confirmNewPassword.val()) {
            $confirmNewPassword.removeClass("valid").addClass("invalid");
            $confirmNewPasswordError.removeClass('d-none');
            return false;
        } else {
            $confirmNewPassword.addClass("valid").removeClass("invalid");
            $confirmNewPasswordError.addClass('d-none');
        }

        $('.forgot-password-wrapper .change-pass-container').addClass('d-none');
        $('.update-password-success').removeClass('d-none');

    });


    /*Profile pic upload*/
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function () {
        readURL(this);
    });

    $(".upload-button").on('click', function () {
        $(".file-upload").click();
    });

    $('.profile-cirle').mouseover(function () {
        $('.profile-pic-overlay').removeClass('d-none');
    });

    $('.profile-cirle').mouseout(function () {
        $('.profile-pic-overlay').addClass('d-none');
    });
});
