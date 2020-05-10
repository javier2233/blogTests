<?php


namespace Blog\Module\EventQueue\Domain;


use Blog\Module\Post\Domain\PostCreatedDomainEvent;

Interface DomainEventPublisher
{
    public function record(PostCreatedDomainEvent ...$postCreatedDomainEvents): void;

    public function publishRecorded(): void;

    public function publish(PostCreatedDomainEvent ...$postCreatedDomainEvent);

}