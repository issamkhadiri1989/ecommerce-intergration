<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\NewsLetterSubscription;
use SebastianBergmann\Template\Template;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function notifyUserAfterCheckout(): void
    {
        // @TODO Send email to the user after checkout.
        $message = $this->buildEmail(/*...*/);

        $this->mailer->send($message);
    }

    public function sendSubscriptionToNewsLettersNotification(NewsLetterSubscription $subscription): void
    {
        /*echo "sending  email to ".$subscription->getSubscriptionEmail();*/
        // Build the email
        // Send the email

        $message = $this->buildEmail(
            'no-reply@system.con',
            $subscription->getSubscriptionEmail(),
            'email/subscribe_to_newsletter.html.twig',
            ['var' => 'value']
        );

        $this->mailer->send($message);
    }

    private function buildEmail(string $from, string $to, string $emailTemplate, array $context = []): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->htmlTemplate($emailTemplate)
            ->context($context);
    }

    /*private function buildEmailWithAttachment(string $from, string $to, string $emailTemplate, array $context = []): TemplatedEmail
    {
        return $this->buildEmail()
            ->attachFromPath(path to the attachment)
            ...
    }*/
}
