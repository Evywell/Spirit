<?php


namespace Spirit\ORM\Entity\Persist;

use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagramInterface;

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

    public function getQuery(): string
    {
        $columns = $this->diagram->getFields();
        $baseQuery = "INSERT INTO {$this->diagram->getTableName()} (%s) VALUES (%s)";

        return $baseQuery;
    }
}
