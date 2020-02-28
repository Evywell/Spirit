<?php

namespace Spirit\ORM\Entity;

use Spirit\Connection;

class EntityManager implements EntityManagerInterface
{

    /**
     * @var array<string,object>
     */
    private array $scheduledInserts = [];
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function persist(object $object): void
    {
        // On pars du principe qu'il s'agit d'une nouvelle entité
        $id = spl_object_hash($object);
        $this->scheduledInserts[$id] = $object;
    }

    public function flush(): void
    {
    }
}
