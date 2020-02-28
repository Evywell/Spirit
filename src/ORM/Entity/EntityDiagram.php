<?php

namespace Spirit\ORM\Entity;

class EntityDiagram implements EntityDiagramInterface
{

    /**
     * @var array<string,array<string,mixed>>
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
        $field = ['type' => $type];
        $field['columnName'] = $options['columnName'] ?? $fieldName;
        $this->fields[$fieldName] = $field;

        return $this;
    }

    public function setEntity(string $entity): EntityDiagramInterface
    {
        $this->entity = $entity;

        return $this;
    }
}
