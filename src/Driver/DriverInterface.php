<?php

namespace Spirit\Driver;

interface DriverInterface
{
    /**
     * @param array<string,mixed> $parameters
     * @return DriverInterface
     */
    public static function build(array $parameters): DriverInterface;

    public function connect(): DatabaseBridgeInterface;
}
