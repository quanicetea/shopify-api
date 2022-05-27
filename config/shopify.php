<?php

return [

    'api_key' => env('SPF_API_KEY', ''),
    'secret_key' => env('SPF_SECRET_KEY', ''),
    'scopes' => [
        'read_customers',
        'write_customers',
        'read_products',
        'write_products',
    ],
    'app_url' => env('APP_URL', ''),
    'app_url_redirect' => env('APP_URL_REDIRECT', ''),
    'api_version' => env('API_VERSION', '2022-04'),
    'app_name_slug' => env('APP_NAME_SLUG', ''),
];
