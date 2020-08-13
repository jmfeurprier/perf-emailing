perf emailing
=============

Allows to handle and submit e-mail messages.

## Installation

```shell script
composer require perf/emailing
```

## Usage

```php
use perf\Emailing\Email;
use perf\Emailing\EmailSender;

$emailSender = new EmailSender();

$email = Email::createBuilder()
    ->setFrom('john.doe@test.com', 'John Doe')
    ->addTo('jane.doe@test.com')
    ->addCc('jim.doe@test.com', 'Jim Doe')
    ->setSubject('Hello!')
    ->setMessage('Goodbye!')
    ->build();

$emailSender->send($email);
```
