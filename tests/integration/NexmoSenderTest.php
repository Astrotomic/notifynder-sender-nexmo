<?php

class NexmoSenderTest extends NotifynderNexmoTestCase
{
    public function testSendNexmoExistence()
    {
        $manager = app('notifynder.sender');
        $this->assertSame(true, $manager->hasSender('sendNexmo'));
        $this->assertSame(true, $manager->sendNexmo([]));
    }

    public function testSendNexmoMissingUsername()
    {
        $this->expectException(\Nexmo\Client\Exception\Request::class);

        $manager = app('notifynder.sender');
        $this->assertSame(true, $manager->sendNexmo([
            new \Fenos\Notifynder\Builder\Notification(),
        ]));
    }
}
