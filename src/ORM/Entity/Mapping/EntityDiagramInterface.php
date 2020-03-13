<?php

namespace Spirit\ORM\Entity\Mapping;

interface EntityDiagramInterface
{

    public function setTableName(string $tableName): self;
    public function setEntity(string $entity): self;

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return EntityDiagramInterface
     */
    public function addField(string $fieldName, string $type, array $options = []): self;

    /** @return array<string,Field> */
    public function getFields(): array;
    public function getTableName(): string;
    public function getEntity(): string;
}
