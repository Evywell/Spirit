<?php

namespace Spirit;

use Spirit\ORM\Entity\Mapping\EntityMapper;

class Settings
{

    /**
     * @var array<string,string>
     */
    private array $drivers = [];

    private EntityMapper $entityMapper;

    public function __construct()
    {
        $this->entityMapper = new EntityMapper();
    }

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

    public function getEntityMapper(): EntityMapper
    {
        return $this->entityMapper;
    }

    /**
     * @param array<string,string> $entityMapping
     */
    public function setEntityMapping(array $entityMapping): void
    {
        $this->entityMapper->setMapping($entityMapping);
    }
}
