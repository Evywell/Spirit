<?php

namespace Spirit\ORM\Entity\Mapping;

class EntityDiagram implements EntityDiagramInterface
{

    /**
     * @var array<string,Field>
     */
    private array $fields;
    private string $tableName;
    private string $entity;

    public function setTableName(string $tableName): EntityDiagramInterface
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return EntityDiagramInterface
     */
    public function addField(string $fieldName, string $type, array $options = []): EntityDiagramInterface
    {
        $field = new Field();
        $field
            ->setType($type)
            ->setColumnName($options['columnName'] ?? $fieldName)
            ->setOptions($options);
        $this->fields[$fieldName] = $field;

        return $this;
    }

    public function setEntity(string $entity): EntityDiagramInterface
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }
}
