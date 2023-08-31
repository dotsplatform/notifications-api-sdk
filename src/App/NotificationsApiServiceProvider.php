<?php

namespace Dotsplatform\Notifications;

use Dotsplatform\Notifications\Clients\NotificationsClient;
use Dotsplatform\Notifications\Clients\NotificationsHttpClient;
use Illuminate\Support\ServiceProvider;

/**
 * Description of NotificationsApiServiceProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */
class NotificationsApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NotificationsClient::class, NotificationsHttpClient::class);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/notifications-api-sdk.php',
            'notifications-server'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/notifications-api-sdk.php' => config_path('notifications-api-sdk.php'),
        ], 'config');
    }

}
