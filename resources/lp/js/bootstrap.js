try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('flexslider');
    //require('isotope-layout/dist/isotope.pkgd');
} catch (e) { console.error(e) }

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
