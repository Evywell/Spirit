<?php


namespace Spirit\ORM\Entity\Mapping;

interface MappingTypeInterface
{

    /**
     * @param string $type
     * @param array<string,mixed> $options
     * @return bool
     */
    public function canManage(string $type, array $options): bool;

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return Field
     */
    public function process(string $fieldName, string $type, array $options = []): Field;
}
