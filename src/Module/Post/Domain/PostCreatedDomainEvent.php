<?php


namespace Blog\Module\Post\Domain;


use Ramsey\Uuid\Uuid;

final class PostCreatedDomainEvent
{
    private $eventId;
    private $referenceId;
    private $data;

    public function __construct(string $referenceId, array $data= [], string $eventId = null)
    {
        $eventId = $eventId ?: Uuid::uuid4()->toString();
        $this->eventId = $eventId;
        $this->referenceId = $referenceId;
        $this->data= $data;

    }

}