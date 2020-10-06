(function () {
    let cards;

    function init() {
        $plans = $('.plans');
        $cards = $plans.find('.card');

        if ($plans.length) {
            bindEvents();
        }
    }

    function bindEvents() {
        let cardSelector = '.plans .card';

        $(document).on('click', cardSelector, handleCardClick);
        $('#plan-form').submit(handlePlanSubmission);
    }

    function handleCardClick() {
        var $this = $(this);
        $this.closest('form').find('#plan').val($this.data('plan-id'));
        $cards.removeClass('active');
        $this.addClass('active');
        $this.closest('form').find('.submit-btn').attr('disabled', false);
    }

    function handlePlanSubmission(e) {
        e.preventDefault();
        let planId = $('#plan').val();
        showLoader();
        $.get('/create-order', { planId: planId }).done(function (resp) {
            if (resp.status) {
                let orderId = resp.orderId;

                $.get('/get-tranx-token', {orderId: orderId}).done(function(resp) {
                    if(resp.status) {
                        $form = $('.paytm-form');
                        let url = resp.host + '/theia/api/v1/showPaymentPage?mid=' + resp.mid + '&orderId=' + orderId;
                        $form.attr('action', url);
                        $form.find('[name="mid"]').val(resp.mid);
                        $form.find('[name="orderId"]').val(orderId);
                        $form.find('[name="txnToken"]').val(resp.txnToken);
                        $form.submit();
                    } else if (typeof resp.msg === 'string') {
                        console.error(resp.msg);
                    }
                }).always(function() {
                    hideLoader();
                });
            } else {
                console.error(resp.msg);
            }
        }).fail(function() {
            hideLoader();
        });
    }

    $(document).ready(function () {
        init();
    });
})();
