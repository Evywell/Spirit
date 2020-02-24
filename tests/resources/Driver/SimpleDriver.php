<?php


namespace Spirit\Test\Driver;


use Spirit\Driver\DatabaseBridgeInterface;
use Spirit\Driver\DriverInterface;

class SimpleDriver implements DriverInterface
{

    /**
     * @inheritDoc
     */
    public static function build(array $parameters): DriverInterface
    {
        return new SimpleDriver();
    }

    /**
     * @inheritDoc
     */
    public function connect(array $parameters, string $username, string $password): DatabaseBridgeInterface
    {
        return new SimpleDatabaseBridge();
    }
}