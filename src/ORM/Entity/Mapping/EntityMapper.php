<?php

namespace Spirit\ORM\Entity\Mapping;

use Spirit\Exception\SpiritException;

class EntityMapper
{

    /** @var array<string,string> */
    private array $mapping;

    /**
     * @param array<string,string> $mapping
     */
    public function __construct(array $mapping = [])
    {
        $this->mapping = $mapping;
    }

    /**
     * @param array<string,string> $mapping
     */
    public function setMapping(array $mapping): void
    {
        $this->mapping = $mapping;
    }

    /**
     * @param string $entityName
     * @return string
     * @throws \Spirit\Exception\EntityMapperException
     */
    public function get(string $entityName): string
    {
        if (!$this->hasMapper($entityName)) {
            throw SpiritException::noEntityMapped($entityName);
        }
        return $this->mapping[$entityName];
    }

    public function hasMapper(string $entityName): bool
    {
        return array_key_exists($entityName, $this->mapping);
    }
}
