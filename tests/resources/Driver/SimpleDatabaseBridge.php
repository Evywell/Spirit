<?php


namespace Spirit\Test\Driver;


use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\StatementInterface;

class SimpleDatabaseBridge implements DatabaseBridgeInterface
{

    /**
     * Execute une requête SQL et retourne le nombre de ligne affecté
     * @param string $statement
     * @return int
     */
    public function exec(string $statement): int
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function query(string $statement): StatementInterface
    {
        return new SimpleStatement();
    }

    /**
     * @inheritDoc
     */
    public function prepare(string $statement, array $options = []): StatementInterface
    {
        return new SimpleStatement();
    }

    public function beginTransaction(): bool
    {
        return false;
    }

    public function commit(): bool
    {
        return false;
    }

    public function rollback(): bool
    {
        return false;
    }
}