<?php

namespace Spirit\Driver;

interface StatementInterface
{

    public const
        FETCH_LAZY   = 1,
        FETCH_ASSOC  = 2,
        FETCH_NUM    = 3,
        FETCH_BOTH   = 4,
        FETCH_OBJ    = 5,
        FETCH_BOUND  = 6,
        FETCH_COLUMN = 7,
        FETCH_CLASS  = 8;

    /**
     * @param array<int,mixed>|null $parameters
     * @return bool
     */
    public function execute($parameters = null): bool;

    public function rowCount(): int;

    /**
     * @param int $fetchStyle
     * @return mixed
     */
    public function fetch(int $fetchStyle);

    /**
     * @param int $fetchStyle
     * @return array<mixed,mixed>
     */
    public function fetchAll(int $fetchStyle): array;
}
