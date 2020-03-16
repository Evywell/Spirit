<?php


namespace Spirit\ORM\Entity\Mapping;

interface MappingTypeInterface
{

    public function canManage(string $type): bool;

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return Field
     */
    public function process(string $fieldName, string $type, array $options = []): Field;
}
