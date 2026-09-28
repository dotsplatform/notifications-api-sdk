<?php

return [
    'notifications-server' => [
        'host' => env('RESOURCES_NOTIFICATIONS_EXTERNAL_HOST', ''),
        'token' => env('INTERNAL_GATEWAY_TOKEN'),
    ],
];
