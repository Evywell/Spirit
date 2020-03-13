<?php

namespace Spirit;

use Spirit\Driver\DriverInterface;
use Spirit\Exception\SpiritConnectionException;
use Spirit\Exception\SpiritException;

class Connection
{

    private Settings $settings;
    private DriverInterface $driver;

    public function __construct(Settings $settings, DriverInterface $driver)
    {
        $this->settings = $settings;
        $this->driver = $driver;
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

    public function getSettings(): Settings
    {
        return $this->settings;
    }
}
