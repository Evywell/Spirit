<?php

namespace Spirit\Driver;

interface StatementInterface
{

    const FETCH_LAZY   = 1;
    const FETCH_ASSOC  = 2;
    const FETCH_NUM    = 3;
    const FETCH_BOTH   = 4;
    const FETCH_OBJ    = 5;
    const FETCH_BOUND  = 6;
    const FETCH_COLUMN = 7;
    const FETCH_CLASS  = 8;

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
