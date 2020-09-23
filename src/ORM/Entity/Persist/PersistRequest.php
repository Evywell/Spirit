<?php

namespace Spirit\ORM\Entity\Persist;

use Spirit\Driver\StatementInterface;
use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagramInterface;
use Spirit\ORM\Entity\Mapping\Field;

class PersistRequest
{

    private EntityManagerInterface $manager;
    /** @var array<Field>  */
    private array $fields;
    private FieldValueResolver $fieldValueResolver;
    private ?StatementInterface $statement;
    private bool $prepared = false;
    /**
     * @var EntityDiagramInterface
     */
    private EntityDiagramInterface $diagram;

    /**
     * @param EntityManagerInterface $manager
     * @param EntityDiagramInterface $diagram
     * @param array<Field> $fields
     */
    public function __construct(EntityManagerInterface $manager, EntityDiagramInterface $diagram, array $fields)
    {
        $this->manager = $manager;
        $this->diagram = $diagram;
        $this->fields = $fields;
        $this->fieldValueResolver = new FieldValueResolver();
    }

    public function getPreparedStatement(): ?StatementInterface
    {
        if ($this->prepared) {
            return $this->statement;
        }

        $this->statement = $this->manager->getConnection()->prepare($this->getQuery());
        $this->prepared = true;
        return $this->statement;
    }

    public function getQuery(): string
    {
        $columns = $this->getColumns();
        $baseQuery = "INSERT INTO %s (%s) VALUES (%s);";
        $parameters = rtrim(str_repeat('?, ', count($columns)), ', ');

        return sprintf(
            $baseQuery,
            $this->diagram->getTableName(),
            implode(', ', $columns),
            $parameters
        );
    }

    /**
     * @return array<string>
     */
    public function getColumns(): array
    {
        return array_reduce(
            $this->fields,
            function (array $carry, Field $field) {
                $carry[] = $field->getColumnName();
                return $carry;
            },
            []
        );
    }

    /**
     * @return array<Field>
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param object $entity
     * @return array<int,mixed>
     */
    public function resolveParameters(object $entity): array
    {
        return array_reduce($this->fields, function (array $carry, Field $field) use ($entity) {
            $carry[] = $this->fieldValueResolver->resolve($field->getFieldName(), $entity);
            return $carry;
        }, []);
    }
}
