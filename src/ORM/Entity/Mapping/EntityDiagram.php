<?php

namespace Spirit\ORM\Entity\Mapping;

use Spirit\ORM\Entity\EntityManagerInterface;

class EntityDiagram implements EntityDiagramInterface
{

    private EntityManagerInterface $manager;
    private MappingTypeHandler $mappingTypeHandler;
    /**
     * @var array<string,Field>
     */
    private array $fields;
    private string $tableName;
    private string $entity;

    public function __construct(EntityManagerInterface $manager, MappingTypeHandler $mappingTypeHandler)
    {
        $this->manager = $manager;
        $this->mappingTypeHandler = $mappingTypeHandler;
    }

    public function setTableName(string $tableName): EntityDiagramInterface
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * @param string $fieldName
     * @param array<string,mixed> $options
     * @return EntityDiagramInterface
     */
    public function increment(string $fieldName, array $options = []): EntityDiagramInterface
    {
        return $this->addField($fieldName, 'integer', array_merge($options, ['extra' => 'AUTO_INCREMENT']));
    }

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return EntityDiagramInterface
     */
    public function addField(string $fieldName, string $type, array $options = []): EntityDiagramInterface
    {
        $field = $this->mappingTypeHandler->process($fieldName, $type, $options) ?? new Field();
        $field
            ->setFieldName($fieldName)
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

    /**
     * @inheritDoc
     */
    public function getWritableFields(): array
    {
        return array_values(array_filter($this->fields, function (Field $field) {
            return !$field->isReadOnly();
        }));
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
