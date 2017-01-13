<?php

use Fenos\Notifynder\NotifynderServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Fenos\Notifynder\Facades\Notifynder as NotifynderFacade;
use Astrotomic\Notifynder\NotifynderSenderNexmoServiceProvider;

abstract class NotifynderNexmoTestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NotifynderServiceProvider::class,
            NotifynderSenderNexmoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Notifynder' => NotifynderFacade::class,
        ];
    }

    protected function getApplicationTimezone($app)
    {
        return 'UTC';
    }

    public function setUp()
    {
        parent::setUp();
        app('config')->set('notifynder.senders.nexmo', [
            'key' => '',
            'secret' => '',
            'callback' => function (\Astrotomic\Notifynder\Senders\Messages\SmsMessage $message, \Fenos\Notifynder\Builder\Notification $notification) {
                return $message
                    ->from('0123456789')
                    ->to('9876543210')
                    ->text($notification->getText());
            },
            'store' => false,
        ]);
    }
}
