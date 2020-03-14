<?php


namespace Spirit\ORM\Entity\Persist;

class Schedule
{

    private int $state;
    private PersistRequest $request;
    /**
     * @var array<string|int,mixed>
     */
    private array $parameters;

    /**
     * @param int $state
     * @param PersistRequest $request
     * @param array<string|int,mixed> $parameters
     */
    public function __construct(int $state, PersistRequest $request, array $parameters)
    {
        $this->state = $state;
        $this->request = $request;
        $this->parameters = $parameters;
    }

    public function getState(): int
    {
        return $this->state;
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
        return $this->parameters;
    }
}
