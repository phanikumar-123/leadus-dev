$(document).ready(function() {
    var $inputFields = $('.animated-label-field').find('input[type="email"], input[type="password"], input[type="text"], input[type="number"]');

    $inputFields.focus(function () {
        $(this).closest('div').find('label').addClass('transform-label');
    });

    $inputFields.focusout(function () {
        if ($(this).val() === "") {
            $(this).closest('div').find('label').removeClass('transform-label');
        }
    });
});
