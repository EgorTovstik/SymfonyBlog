<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Article;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Article::class)]
class ArticleEntityListener
{
    public function __construct(private readonly Security $security)
    {

    }
    public function prePersist(PostPersistEventArgs $event): void
    {
        /** @var Article $entity */
        $entity = $event->getObject();
        $entity->setCreatedAT(new \DateTimeImmutable());
        $entity->setAuthor($this->security->getUser());
    }
}