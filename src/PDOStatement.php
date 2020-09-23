<?php

namespace Spirit;

use Spirit\Driver\StatementInterface;

class PDOStatement implements StatementInterface
{

    /**
     * @var \PDOStatement<mixed>
     */
    private \PDOStatement $statement;

    /**
     * @param \PDOStatement<mixed> $statement
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }

    /**
     * @param array<int,mixed>|null $parameters
     * @return bool
     */
    public function execute($parameters = null): bool
    {
        return $this->statement->execute($parameters);
    }

    /**
     * @param int $fetchStyle
     * @return mixed
     */
    public function fetch(int $fetchStyle = StatementInterface::FETCH_BOTH)
    {
        return $this->statement->fetch($fetchStyle);
    }

    /**
     * @param int $fetchStyle
     * @return array<mixed,mixed>
     */
    public function fetchAll(int $fetchStyle = StatementInterface::FETCH_BOTH): array
    {
        return $this->statement->fetchAll($fetchStyle) ?: [];
    }
}
