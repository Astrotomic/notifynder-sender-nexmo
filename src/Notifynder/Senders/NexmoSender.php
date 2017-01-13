<?php

namespace Astrotomic\Notifynder\Senders;

use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;
use Astrotomic\Notifynder\Senders\Messages\SmsMessage;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic as CredentialsBasic;

class NexmoSender implements SenderContract
{
    /**
     * @var array
     */
    protected $notifications;

    /**
     * NexmoSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function send(SenderManagerContract $sender)
    {
        $key = config('notifynder.senders.nexmo.key');
        $secret = config('notifynder.senders.nexmo.secret');
        $store = config('notifynder.senders.nexmo.store', false);
        $callback = config('notifynder.senders.nexmo.callback');
        $client = new Client(new CredentialsBasic($key, $secret));
        foreach ($this->notifications as $notification) {
            $sms = call_user_func($callback, new SmsMessage(), $notification);
            $client->messages()->send([
                'from' => $sms->getOriginator(),
                'to' => $sms->getRecipient(),
                'text' => $sms->getBody(),
            ]);
        }

        if ($store) {
            return $sender->send($this->notifications);
        }

        return true;
    }
}
