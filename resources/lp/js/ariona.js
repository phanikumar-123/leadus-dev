(function () {

    $(document).ready(function () {

        /* Data background image generator */
        var elBgImg = "[data-bg-image]";
        $(elBgImg).each(function () {
            var image = $(this).data("bg-image");
            $(this).css("background-image", "url(" + image + ")");
        });

        /* Data background color generator */
        var elBgClr = "[data-bg-color]";
        $(elBgClr).each(function () {
            var color = $(this).data("bg-color");
            $(this).css("background-color", color);
        });

        /* Filterable Items */
        /* var $container = $('.filterable-items');
        $container.isotope({
            filter: '*',
            layoutMode: 'fitRows',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        $('.filterable-nav a').click(function (e) {
            e.preventDefault();
            $('.filterable-nav .current').removeClass('current');
            $(this).addClass('current');

            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });

        $('.mobile-filter').change(function () {
            var selector = $(this).val();
            $container.isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        }); */

    })

})(jQuery);
