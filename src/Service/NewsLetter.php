<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\NewsLetterSubscription;

class NewsLetter
{
    public function __construct(private Mailer $mailer)
    {
    }

    public function subscribeToNewsLetter(NewsLetterSubscription $subscription): void
    {
        // do something like saving to database
        /*echo "Saving to database...";*/
        // and send mail to  subscriber telling him that the operation has been saved
        $this->mailer->sendSubscriptionToNewsLettersNotification($subscription);
    }
}
