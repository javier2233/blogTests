<?php


namespace Blog\Module\Event\Domain;


use Blog\Module\Post\Domain\PostCreatedDomainEvent;

class AggregateRoot
{
    private $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(PostCreatedDomainEvent $postCreatedDomainEvent){
        $this->domainEvents[] = $postCreatedDomainEvent;
    }

}