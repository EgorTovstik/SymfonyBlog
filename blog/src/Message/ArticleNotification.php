<?php

declare(strict_types=1);

namespace App\Message;

class ArticleNotification
{
    public function __construct(
        private readonly int $articleID,
        private readonly string $title,
        private readonly string $body,
        private readonly int $authorID,
        private readonly bool $isCreation,
    )
    {
    }

    public function getArticleID(): int
    {
        return $this->articleID;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthorID(): int
    {
        return $this->authorID;
    }

    public function isCreation(): bool
    {
        return $this->isCreation;
    }

}