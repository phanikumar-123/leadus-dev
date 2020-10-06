require('./bootstrap');
require('./ariona');

(function ($, document, window) {

    $(document).ready(function () {

        // Cloning main navigation for mobile menu
        $(".mobile-navigation").append($(".main-navigation .menu").clone());

        // Mobile menu toggle
        $(".menu-toggle").click(function () {
            $(".mobile-navigation").slideToggle();
        });

        $(".hero").flexslider({
            directionNav: false,
            controlNav: true
        });

        var $section = $(".fullwidth-block");
        document.addEventListener('scroll', function () {
            var activeElement;
            $('.current-menu-item').removeClass('current-menu-item');

            $section.each(function () {
                var rect = this.getBoundingClientRect();

                if (rect.top <= (document.documentElement.clientHeight / 2)) {
                    activeElement = this.id;
                }
            });
            $('a[href="#' + activeElement + '"]').parent("div").addClass("current-menu-item");
        });
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            $('.site-header').addClass("sticky");
        } else {
            $('.site-header').removeClass("sticky");
        }
    });

    var menuItem = $(".menu-item a");
    if (menuItem.length) {
        menuItem.on('click', function (e) {
            var hash = this.hash;

            if (hash && hash.startsWith('#')) {
                e.preventDefault();

                $('html, body').animate({
                    scrollTop: ($(hash).offset().top - 25)
                }, 800);
            }
        });
    }
})(jQuery, document, window);
