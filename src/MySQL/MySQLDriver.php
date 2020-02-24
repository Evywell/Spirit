<?php

namespace Spirit\MySQL;


use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\DriverInterface;

class MySQLDriver implements DriverInterface
{

    /**
     * @param array<string,mixed> $parameters
     * @return DriverInterface
     */
    public static function build(array $parameters): DriverInterface
    {
        return new MySQLDriver();
    }

    /**
     * @param array<string,mixed> $parameters
     * @param string $username
     * @param string $password
     * @return DatabaseBridgeInterface
     */
    public function connect(array $parameters, string $username, string $password): DatabaseBridgeInterface
    {
        return new MySQLDatabaseBridge($parameters, $username, $password);
    }
}