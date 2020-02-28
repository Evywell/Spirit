<?php


namespace Spirit;

use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\StatementInterface;

abstract class PDODatabaseBridge implements DatabaseBridgeInterface
{
    /**
     * @var array<string,mixed>
     */
    protected array $parameters;

    protected \PDO $pdo;

    /**
     * @param array<string,mixed> $parameters
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(array $parameters, ?string $username, ?string $password)
    {
        $this->parameters = $parameters;
        $this->pdo = new \PDO($this->getDsn(), $username, $password, $parameters['options'] ?? []);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // $this->pdo->setAttribute(\PDO::ATTR_STATEMENT_CLASS, PDOStatement::class);
    }

    /**
     * @inheritDoc
     */
    public function exec(string $statement): int
    {
        return $this->pdo->exec($statement);
    }

    public function query(string $statement): ?StatementInterface
    {
        $pdoStatement = $this->pdo->query($statement);
        return $pdoStatement ? new PDOStatement($pdoStatement) : null;
    }

    /**
     * @inheritDoc
     */
    public function prepare(string $statement, array $options = []): ?StatementInterface
    {
        $pdoStatement = $this->pdo->prepare($statement, $options);
        return new PDOStatement($pdoStatement);
    }

    public function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->pdo->commit();
    }

    public function rollback(): bool
    {
        return $this->pdo->rollBack();
    }

    abstract public function getDsn(): string;
}
