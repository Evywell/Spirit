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

    /**
     * @param string $fieldName
     * @param array<string,mixed> $options
     * @return EntityDiagramInterface
     */
    public function increment(string $fieldName, array $options = []): self;

    /** @return array<string,Field> */
    public function getFields(): array;
    /**
     * Retourne la liste des champs qui peuvent être modifiés (qui n'est pas read-only)
     * @return array<Field>
     */
    public function getWritableFields(): array;
    public function getTableName(): string;
    public function getEntity(): string;
}
