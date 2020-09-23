<?php

namespace Spirit\ORM\Entity\Persist;

class Schedule
{

    private object $entity;
    private PersistRequest $request;
    private int $state;

    public function __construct(object $entity, PersistRequest $request, int $state)
    {
        $this->entity = $entity;
        $this->request = $request;
        $this->state = $state;
    }

    public function getRequest(): PersistRequest
    {
        return $this->request;
    }

    /**
     * @return array<string|int,mixed>
     */
    public function getParameters(): array
    {
        return $this->request->resolveParameters($this->entity);
    }

    public function getState(): int
    {
        return $this->state;
    }
}
