<?php

namespace Astrotomic\Notifynder;

use Illuminate\Support\ServiceProvider;
use Astrotomic\Notifynder\Senders\NexmoSender;

class NotifynderSenderNexmoServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('notifynder')->extend('sendNexmo', function (array $notifications) {
            return new NexmoSender($notifications);
        });
    }
}
