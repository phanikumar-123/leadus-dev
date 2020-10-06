@extends('layouts.site-base')

@section('body')
<form method="post" name="paytm">
    <table border="1">
        <tbody>
            <input type="hidden" name="mid" value="YOUR_MID_HERE">
            <input type="hidden" name="orderId" value="YOUR_ORDERID_HERE">
            <input type="hidden" name="txnToken" value="YOUR_TXNTOKEN_HERE">
        </tbody>
    </table>
</form>
@endsection

@section('footer-scripts')
{{-- <script type="application/javascript" crossorigin="anonymous"
    src="https://securegw-stage.paytm.in/merchantpgpui/checkoutjs/merchants/kVRoRj68804427199465.js"
    onload="onScriptLoad();" defer> </script> --}}
<script>
    /* function onScriptLoad(){
        var orderId = 'ORDERID_017',
            amount = '2.00',
            mid = 'kVRoRj68804427199465';
        $.get('/tranx-token', {amount: amount, orderid: orderId}).done(function(resp) {
            if(typeof resp.body.resultInfo.resultStatus === 'string' && resp.body.resultInfo.resultStatus === 'S') {
                var txnToken = resp.body.txnToken;
                var config = {
                    "root": "",
                    "flow": "DEFAULT",
                    "data": {
                    "orderId": orderId,
                    "token":  txnToken,
                    "tokenType": "TXN_TOKEN",
                    "amount": amount
                    },
                    "handler": {
                        "notifyMerchant": function(eventName,data){
                            console.log("notifyMerchant handler function called");
                            console.log("eventName => ",eventName);
                            console.log("data => ",data);
                        }
                    }
                }

                if(window.Paytm && window.Paytm.CheckoutJS){
                    window.Paytm.CheckoutJS.onLoad(function excecuteAfterCompleteLoad() {
                        // initialze configuration using init method
                        window.Paytm.CheckoutJS.init(config).then(function onSuccess() {
                            // after successfully updating configuration, invoke Blink Checkout
                            window.Paytm.CheckoutJS.invoke();
                        }).catch(function onError(error){
                            console.log("error => ",error);
                        });
                    });
                }
            }
    });
    } */

    var orderId = '2',
            amount = '2.00',
            mid = 'kVRoRj68804427199465';
        $.get('/tranx-token', {amount: amount, orderid: orderId}).done(function(resp) {
            if(typeof resp.body.resultInfo.resultStatus === 'string' && resp.body.resultInfo.resultStatus === 'S') {
                $form = $('[name="paytm"]');
                var url = 'https://securegw-stage.paytm.in/theia/api/v1/showPaymentPage?mid=' + mid + '&orderId=' + orderId;
                $form.attr('action', url);
                $form.find('[name="mid"]').val(mid);
                $form.find('[name="orderId"]').val(orderId);
                $form.find('[name="txnToken"]').val(resp.body.txnToken);
                $form.submit();
            }
  });
</script>
@endsection
