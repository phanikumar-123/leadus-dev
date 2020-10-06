<?php

return [

    'paytm' => [

        'mid' => env('PAYTM_MERCHNANT_ID', ''),

        'merc_key' => env('PAYTM_MERCHANT_KEY', ''),

        'host' => env('PAYTM_HOST', 'https://securegw-stage.paytm.in'),

        'callback_url' => env('CALLBACK_URL', '')
    ]
];
