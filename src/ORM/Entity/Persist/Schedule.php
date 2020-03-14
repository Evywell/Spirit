<?php


namespace Spirit\ORM\Entity\Persist;

class Schedule
{

    private int $state;
    private PersistRequest $request;

    public function __construct(int $state, PersistRequest $request)
    {
        $this->state = $state;
        $this->request = $request;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getRequest(): PersistRequest
    {
        return $this->request;
    }
}
