<?php
return [
    'api_key' => env('SMS_RU_API_KEY'),
    'from' => env('SMS_RU_FROM', 'NikahTime'),
    'translit' => env('SMS_RU_TRANSLIT', 0),
    'test' => env('SMS_RU_TEST', 1),
    'partner_id' => env('SMS_RU_PARTNER_ID', 0)
];
