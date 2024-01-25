<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET'],

    'allowed_origins' => ['*', 'http://127.0.0.1:8000/'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['X-Custom-Header'],

    'max_age' => 0,

    'supports_credentials' => false,

];
