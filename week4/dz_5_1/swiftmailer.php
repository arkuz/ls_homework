<?php

require_once __DIR__ . '\..\..\vendor\autoload.php';
include 'config.php';

$mail = [
    'subject' => 'Wonderful Subject',
    'from' => [
        MAIL_USER => 'Sender',
    ],
    'to' => [
        MAIL_USER => 'Receiver',
    ],
    'body' => 'Test message',
    'file' => 'test.txt',
];

try {
    $transport = (new Swift_SmtpTransport(MAIL_SERVER, MAIL_PORT, 'ssl'))
        ->setUsername(MAIL_USER)
        ->setPassword(MAIL_PASSWORD);

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message($mail['subject']))
        ->setFrom($mail['from'])
        ->setTo($mail['to'])
        ->setBody($mail['body'])
        ->attach(Swift_Attachment::fromPath($mail['file']));

    $result = $mailer->send($message);

    echo 'The email was sent successfully!';
} catch (Exception $e) {
    echo $e->getMessage();
}
