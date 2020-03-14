<?php

namespace Spirit\MySQL;

use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\DriverInterface;

class MySQLDriver implements DriverInterface
{

    /**
     * @var array<string,mixed>
     */
    private array $parameters;

    /**
     * @param array<string,mixed> $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param array<string,mixed> $parameters
     * @return DriverInterface
     */
    public static function build(array $parameters): DriverInterface
    {
        return new MySQLDriver($parameters);
    }

    public function connect(): DatabaseBridgeInterface
    {
        $username = $this->parameters['username'];
        $password = $this->parameters['password'];

        return new MySQLDatabaseBridge($this->parameters, $username, $password);
    }
}
