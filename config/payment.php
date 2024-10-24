<?php

return [
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'test_mode' => env('PAYPAL_TEST_MODE', false),
    ]
    // you can add whatever any type of payments here
];
