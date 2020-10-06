try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    const AUTOFILLED = 'is-autofilled'

    document.querySelectorAll('input').forEach(elem => {
        elem.addEventListener('animationstart', (event) => {
            let elem = event.currentTarget;
            console.log('Email field value: ', elem.value);
            if (event.animationName === 'onAutoFillStart') {
                elem.classList.add(AUTOFILLED);
                $(elem).closest('div').find('label').addClass('transform-label');
            }
        }, false);
    });

    /* Adding Jquery Plugins */
    if (typeof $ === 'function') {
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();

            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    }

    if ($('meta[name="csrf-token"]').length) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    require('bootstrap');
    require('jquery.easing');
    require('jquery.toaster');
    //require('datatables.net')
    require('datatables.net-bs4');
    require('bs4-summernote');
} catch (e) { console.error(e) }
