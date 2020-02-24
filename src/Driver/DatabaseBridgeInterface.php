<?php

namespace Spirit\Driver;

interface DatabaseBridgeInterface
{

    /**
     * Execute une requête SQL et retourne le nombre de ligne affecté
     * @param string $statement
     * @return int
     */
    public function exec(string $statement): int;

    public function query(string $statement): ?StatementInterface;

    /**
     * @param string $statement
     * @param array<mixed,mixed> $options
     * @return StatementInterface
     */
    public function prepare(string $statement, array $options = []): ?StatementInterface;

    public function beginTransaction(): bool;

    public function commit(): bool;

    public function rollback(): bool;

}