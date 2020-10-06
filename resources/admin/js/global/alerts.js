const { unionWith } = require("lodash");

(function() {
    let utils = window.utils || {};

    utils.showError = function(msg, title) {
        $.toaster({
            message: msg,
            title: title,
            priority: 'danger',
            settings: {
                'timeout': 5000
            }
        });
    }

    window.utils = utils;
})();
