# Notifynder 4 Nexmo Sender - Laravel 5

[![GitHub release](https://img.shields.io/github/release/astrotomic/notifynder-sender-nexmo.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-nexmo/releases)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/astrotomic/notifynder-sender-nexmo/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/astrotomic/notifynder-sender-nexmo.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-nexmo/issues)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/notifynder-sender-nexmo.svg?style=flat-square)](https://packagist.org/packages/astrotomic/notifynder-sender-nexmo)

[![StyleCI](https://styleci.io/repos/78859194/shield)](https://styleci.io/repos/78859194)

[![Code Climate](https://img.shields.io/codeclimate/github/Astrotomic/notifynder-sender-nexmo.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/notifynder-sender-nexmo)

[![Slack Team](https://img.shields.io/badge/slack-astrotomic-orange.svg?style=flat-square)](https://astrotomic.slack.com)
[![Slack join](https://img.shields.io/badge/slack-join-green.svg?style=social)](https://notifynder.signup.team)


Documentation: **[Notifynder Docu](http://notifynder.info)**

-----

## Installation

### Step 1

```
composer require astrotomic/notifynder-sender-nexmo
```

### Step 2

Add the following string to `config/app.php`

**Providers array:**

```
Astrotomic\Notifynder\NotifynderSenderNexmoServiceProvider::class,
```

### Step 3

Add the following array to `config/notifynder.php`

```php
'senders' => [
    'nexmo' => [
        'key' => '',
        'secret' => '',
        'callback' => function(\Astrotomic\Notifynder\Senders\Messages\SmsMessage $message, \Fenos\Notifynder\Models\Notification $notification) {
            return $message
                ->from(...)
                ->to(...)
                ->body($notification->getText());
        }
        'store' => false, // wether you want to also store the notifications in database
    ],
],
```