<?php

return [
    'notifications-server' => [
        'host' => env('RESOURCES_NOTIFICATIONS_EXTERNAL_HOST', ''),
        'token' => env('NOTIFICATIONS_INTERNAL_GATEWAY_TOKEN'),
    ],
];
