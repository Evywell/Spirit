<?php


namespace Spirit\ORM\Entity\Persist;

use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagramInterface;
use Spirit\ORM\Entity\Mapping\Field;

class PersistRequest
{

    private EntityManagerInterface $manager;
    private object $entity;
    private EntityDiagramInterface $diagram;

    public function __construct(EntityManagerInterface $manager, object $entity, EntityDiagramInterface $diagram)
    {
        $this->manager = $manager;
        $this->entity = $entity;
        $this->diagram = $diagram;
    }

    /**
     * @return array<string|int,mixed>
     */
    public function getParameters(): array
    {
        return [];
    }

    public function getQuery(): string
    {
        $columns = array_reduce(
            $this->diagram->getFields(),
            function (array $carry, Field $field) {
                $carry[] = $field->getColumnName();
                return $carry;
            },
            []
        );
        $baseQuery = "INSERT INTO %s (%s) VALUES (%s);";
        $parameters = rtrim(str_repeat('?, ', count($columns)), ', ');

        return sprintf(
            $baseQuery,
            $this->diagram->getTableName(),
            implode(', ', $columns),
            $parameters
        );
    }
}
