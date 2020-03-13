<?php

namespace Spirit\ORM\Entity;

use Spirit\Connection;
use Spirit\ORM\Entity\Mapping\EntityDescriberInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagram;
use Spirit\ORM\Entity\Mapping\EntityMapper;
use Spirit\ORM\Entity\Persist\PersistSchedule;

class EntityManager implements EntityManagerInterface
{

    private Connection $connection;
    private PersistSchedule $scheduler;
    private EntityMapper $mapper;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->scheduler = new PersistSchedule($this);
        $this->mapper = $connection->getSettings()->getEntityMapper();
    }

    public function persist(object $object): void
    {
        // On part du principe qu'il s'agit d'une nouvelle entité
        $describerClass = $this->mapper->get(get_class($object));
        /** @var EntityDescriberInterface $describer */
        $describer = new $describerClass();
        $diagram = new EntityDiagram();
        $describer->describe($diagram);
        $id = spl_object_hash($object);
        $this->scheduler->schedule($id, $object, self::STATE_NEW, $diagram);
    }

    public function flush(): void
    {
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }

    public function getEntityMapper(): EntityMapper
    {
        return $this->connection->getSettings()->getEntityMapper();
    }
}
