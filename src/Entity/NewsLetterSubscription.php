<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class NewsLetterSubscription
{
    #[Assert\NotNull(message: 'The email is required'), Assert\Email(message: 'please you need to provide a valid email address')]
    private string $subscriptionEmail;

    public function getSubscriptionEmail(): string
    {
        return $this->subscriptionEmail;
    }

    public function setSubscriptionEmail(string $subscriptionEmail): self
    {
        $this->subscriptionEmail = $subscriptionEmail;

        return $this;
    }
}
