<?php


namespace Spirit\Test\Driver;


use Spirit\Driver\StatementInterface;

class SimpleStatement implements StatementInterface
{

    /**
     * @param array<int,mixed>|null $parameters
     * @return bool
     */
    public function execute($parameters = null): bool
    {
        return false;
    }

    public function rowCount(): int
    {
        return 0;
    }

    /**
     * @param int $fetchStyle
     * @return mixed
     */
    public function fetch(int $fetchStyle)
    {
        return null;
    }

    public function fetchAll(int $fetchStyle): array
    {
        return [];
    }
}