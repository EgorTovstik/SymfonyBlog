<?php

namespace App\MessageHandler;

use App\Message\ArticleNotification;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Config\Twig\MailerConfig;

#[AsMessageHandler]
class ArticleMessageHandler
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MailerInterface $mailer,
    )
    {
    }

    public function __invoke(ArticleNotification $message): void
    {
        $this->logger->info(sprintf('Got new message from queue: Article id = %d, title = %s has been %s',
            $message->getArticleId(),
            $message->getTitle(),
            $message->isCreation() ? 'created' : 'updated'
        ));

        //$this->mailer->send(...);

        sleep(3);
    }
}