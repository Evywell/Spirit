<?php

namespace Spirit;

use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\DriverInterface;
use Spirit\Driver\StatementInterface;
use Spirit\Exception\SpiritConnectionException;
use Spirit\Exception\SpiritException;

class Connection
{

    private Settings $settings;
    private DriverInterface $driver;
    private DatabaseBridgeInterface $databaseBridge;
    private bool $connected = false;

    public function __construct(Settings $settings, DriverInterface $driver)
    {
        $this->settings = $settings;
        $this->driver = $driver;
    }

    public function exec(string $statement): int
    {
        $this->connect();
        return $this->databaseBridge->exec($statement);
    }

    public function prepare(string $statement): ?StatementInterface
    {
        $this->connect();
        return $this->databaseBridge->prepare($statement);
    }

    /**
     * @param StatementInterface $stmt
     * @param array<mixed,mixed>|null $parameters
     * @return bool
     */
    public function execute(StatementInterface $stmt, ?array $parameters = null): bool
    {
        $this->connect();
        return $stmt->execute($parameters);
    }

    /**
     * @param string $statement
     * @param array<mixed,mixed>|null $parameters
     * @return bool
     */
    public function prepareAndExecute(string $statement, ?array $parameters = null): bool
    {
        $this->connect();
        if ($stmt = $this->prepare($statement)) {
            return $this->execute($stmt, $parameters);
        }

        return false;
    }

    public function beginTransaction(): bool
    {
        $this->connect();
        return $this->databaseBridge->beginTransaction();
    }

    public function commit(): bool
    {
        $this->connect();
        return $this->databaseBridge->commit();
    }

    /**
     * @param callable $queries
     * @throws SpiritConnectionException
     */
    public function createTransaction(callable $queries): void
    {
        if (!$this->beginTransaction()) {
            throw SpiritException::cannotBeginTransaction();
        }

        call_user_func($queries, $this);

        if (!$this->commit()) {
            throw SpiritException::cannotCommitTransaction();
        }
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }

    private function connect(): void
    {
        if ($this->connected) {
            return;
        }

        $this->databaseBridge = $this->driver->connect();
        $this->connected = true;
    }

    /**
     * @param Settings $settings
     * @param array<string,mixed> $parameters
     * @return Connection
     * @throws SpiritConnectionException
     */
    public static function create(Settings $settings, array $parameters): Connection
    {
        $driverName = $parameters['driver'] ?? null;
        if (!$driverName) {
            throw SpiritException::noDriverSpecified();
        }
        $driverClass = $settings->getDriver($driverName);
        if (!$driverClass) {
            throw SpiritException::unknownDriver($driverName);
        }

        if (!is_subclass_of($driverClass, DriverInterface::class)) {
            throw SpiritException::notADriver($driverClass);
        }

        $driver = $driverClass::build($parameters);

        return new Connection($settings, $driver);
    }
}
