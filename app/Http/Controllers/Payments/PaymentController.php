<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Order;
use App\Paytm\PaytmChecksum;
use App\SubscpPlan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $data = $request->validate([
            'planId' => 'required|string'
        ]);
        $userid = Auth::id();
        $planId = $data['planId'];
        $msg = [];

        $plan = SubscpPlan::find($planId);

        if ($plan != null && $plan->is_plan_active) {
            $amount = $plan->plan_total_price;
            $order = Order::where([
                ['amount', $amount],
                ['user_id', $userid],
                ['status', 'created']
            ])->first();

            if ($order == null) {
                $order = Order::create([
                    'amount' => $amount,
                    'status' => 'created',
                    'user_id' => $userid,
                    'subscp_plan_id' => $planId
                ]);
            }

            $msg = array(
                'status' => true,
                'orderId' => $order->id,
                'msg' => 'Order created successfully'
            );
        } else {
            $msg = array(
                'status' => false,
                'msg' => 'Plan id not found!!'
            );
        }

        return response()->json($msg);
    }

    public function generatePaytmTrxToken(Request $request)
    {

        $data = $request->validate([
            'orderId' => 'required|string'
        ]);

        $paytmParams = array();
        $mid = config('paymentgateways.paytm.mid');
        $mercKey = config('paymentgateways.paytm.merc_key');
        $orderId = $data['orderId'];
        $host = config('paymentgateways.paytm.host');

        $order = Order::find($orderId);

        if ($order != null) {
            $paytmParams["body"] = array(
                "requestType"   => "Payment",
                "mid"           => $mid,
                "websiteName"   => "WEBSTAGING",
                "orderId"       => $orderId,
                "callbackUrl"   => config('paymentgateways.paytm.callback_url'),
                "txnAmount"     => array(
                    "value"     => $order->amount,
                    "currency"  => "INR",
                ),
                "userInfo"      => array(
                    "custId"    => $request->user()->id,
                ),
            );

            $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $mercKey);

            $paytmParams["head"] = array(
                "signature"    => $checksum
            );

            $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

            $url = $host . "/theia/api/v1/initiateTransaction?mid=" . $mid . "&orderId=" . $orderId;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $paytmResponse = curl_exec($ch);

            $jsonResponse = json_decode($paytmResponse);
            $body = $jsonResponse->body;
            $status = $body->resultInfo->resultStatus == 'S';

            $order->initiate_api_resp = $paytmResponse;

            $response = new stdClass;
            $response->status = $status;

            if ($status) {
                $response->txnToken = $body->txnToken;
                $response->host = $host;
                $response->mid = $mid;
                $response->msg = 'Transaction token acquired!!';

                $order->status = 'processing';
            } else {
                $response->msg = 'Error getting transaction token. Error msg is: ' . $body->resultInfo->resultMsg;
            }
            $order->save();

            return response()->json($response);

        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Order not found!!'
            ]);
        }
    }

    public function validateTxn(Request $request)
    {
        $paytmParams = $request->all();
        $mid = config('paymentgateways.paytm.mid');
        $mercKey = config('paymentgateways.paytm.merc_key');

        $paytmChecksum = $request->input('CHECKSUMHASH');

        $isVerifySignature = PaytmChecksum::verifySignature($paytmParams, $mercKey, $paytmChecksum);
        if ($isVerifySignature) {
            $response = $this->getTransactionStatus($paytmParams['ORDERID'], $mid, $mercKey);

            // Log Paytm response data in local, so that its helpful to check issues
            if (App::environment(['local', 'testing'])) {
                Log::info('Paytm Transaction status response: '. $response['response']);
            }

            if($response['status']) {
                return redirect('/home');
            } else {
                return redirect('/payment-failed');
            }
        } else {
            return redirect('/payment-failed');
        }
    }

    private function getTransactionStatus($orderId, $mid, $mercKey)
    {
        $paytmParams = array();

        $paytmParams["body"] = array(
            "mid" => $mid,
            "orderId" => $orderId,
        );

        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $mercKey);

        $paytmParams["head"] = array(
            "signature"    => $checksum
        );

        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        $url = config('paymentgateways.paytm.host') . "/v3/order/status";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $paytmResponse = curl_exec($ch);
        $jsonResponse = json_decode($paytmResponse);
        $resultInfo = $jsonResponse->body->resultInfo;
        $order = Order::find($orderId);
        $order->transaction_status_resp = $paytmResponse;
        $status = false;

        if ($resultInfo->resultCode == '01') {
            $order->status = 'success';

            $plan = SubscpPlan::find($order->subscp_plan_id);
            $user = User::find($order->user_id);
            $expiryDate = Carbon::now()->addDays($plan->plan_validity);

            $user->active_plan = $plan->id;
            $user->plan_expires_on = $expiryDate;
            $user->save();
            $status = true;
        } else {
            $order->status = 'failed';
        }
        $order->save();

        return array(
            'status' => $status,
            'response' => $paytmResponse
        );
    }
}
