<?php

namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactEmail
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * MailerService constructor.
     *
     * @param MailerInterface       $mailer
     * @param Environment   $twig
     */
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param string $subject
     * @param string $mailFrom
     * @param string $mailTo
     * @param string $template
     * @param array $parameters
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function send(string $subject, string $mailFrom, string $mailTo, string $template, array $parameters): void
    {
        try {
            $email = (new Email())
                ->from($mailFrom)
                ->to($mailTo)
                ->subject($subject)
                ->html(
                    $this->twig->render($template, $parameters)
                );

                $this->mailer->send($email);
        } catch (TransportException $e) {
            print $e->getMessage() . "\n";
            throw $e;
        }
    }
}
