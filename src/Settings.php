<?php

namespace Spirit;

use Spirit\Driver\DriverInterface;

class Settings
{

    /**
     * @var array<string,string>
     */
    private array $drivers = [];

    /**
     * @param array<string,string> $drivers
     */
    public function setDrivers(array $drivers): void
    {
        $this->drivers = $drivers;
    }

    public function registerDriver(string $driverName, string $driverClass): void
    {
        $this->drivers[$driverName] = $driverClass;
    }

    public function getDriver(string $driverName): ?string
    {
        return $this->drivers[$driverName] ?? null;
    }
}
