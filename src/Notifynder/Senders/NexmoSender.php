<?php

namespace Astrotomic\Notifynder\Senders;

use Nexmo\Client;
use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;
use Astrotomic\Notifynder\Senders\Messages\SmsMessage;
use Nexmo\Client\Credentials\Basic as CredentialsBasic;
use Fenos\Notifynder\Traits\SenderCallback;

class NexmoSender implements SenderContract
{
    use SenderCallback;

    /**
     * @var array
     */
    protected $notifications;

    /**
     * @var array
     */
    protected $config;

    /**
     * NexmoSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
        $this->config = notifynder_config('senders.nexmo');
    }

    public function send(SenderManagerContract $sender)
    {
        $key = $this->config['key'];
        $secret = $this->config['secret'];
        $store = $this->config['store'];
        $callback = $this->getCallback();
        $client = new Client(new CredentialsBasic($key, $secret));
        foreach ($this->notifications as $notification) {
            $sms = call_user_func($callback, new SmsMessage(), $notification);
            $client->message()->send([
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
