<?php

namespace App\Service;

use App\Entity\ClientProduct;

class NotificationService
{
    public function sendNotification(ClientProduct $clientProduct): void
    {
        /**
         * TODO: send email|sms with Symfony Messenger and background worker
         * see https://symfony.com/doc/current/messenger.html
         * TBD:
         * 1) decide a transport (email or sms)
         * 2) create a message
         * 3) send message to transport queue
         * 4) handle message
         * 5) save notify result to DB
        **/
    }
}