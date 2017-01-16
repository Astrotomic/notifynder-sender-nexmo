<?php

use Fenos\Notifynder\NotifynderServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Fenos\Notifynder\Facades\Notifynder as NotifynderFacade;
use Astrotomic\Notifynder\NotifynderSenderNexmoServiceProvider;
use Astrotomic\Notifynder\Senders\NexmoSender;
use Astrotomic\Notifynder\Senders\Messages\SmsMessage;
use Fenos\Notifynder\Builder\Notification;

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
            'store' => false,
        ]);
        app('notifynder.sender')->setCallback(NexmoSender::class, function (SmsMessage $message, Notification $notification) {
            return $message
                ->from('0123456789')
                ->to('9876543210')
                ->text($notification->getText());
        });
    }
}
