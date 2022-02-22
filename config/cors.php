<?php

return [

    'paths' => ['api/*'],

    'allow_credentials' => false,
    'allow_methods' => ['POST', 'GET', 'OPTIONS', 'PUT', 'PATCH', 'DELETE'],
    'allow_headers' => ['Content-Type', 'X-Auth-Token', 'Origin', 'Authorization',],

    'expose_headers' => ['Cache-Control', 'Content-Language', 'Content-Type', 'Expires', 'Last-Modified', 'Pragma',],
    'allow_origins' => ['*'],
    'allowed_origins_patterns' => ['*'],
    'supports_credentials' => true,

    'forbidden_response' => [
        'message' => 'Forbidden (cors).',
        'status' => 403,
    ],

    'max_age' => 60 * 60 * 24,

];
