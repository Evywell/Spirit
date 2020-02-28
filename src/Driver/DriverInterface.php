<?php

namespace Spirit\Driver;

interface DriverInterface
{
    /**
     * @param array<string,mixed> $parameters
     * @return DriverInterface
     */
    public static function build(array $parameters): DriverInterface;

    /**
     * @param array<string,mixed> $parameters
     * @param string $username
     * @param string $password
     * @return DatabaseBridgeInterface
     */
    public function connect(array $parameters, string $username, string $password): DatabaseBridgeInterface;
}
