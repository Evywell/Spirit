<?php

namespace Spirit\ORM\Entity;

use Spirit\Connection;
use Spirit\Exception\EntityManagerException;
use Spirit\ORM\Entity\Mapping\EntityDescriberInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagram;
use Spirit\ORM\Entity\Mapping\EntityMapper;
use Spirit\ORM\Entity\Persist\PersistRequest;
use Spirit\ORM\Entity\Persist\PersistSchedule;
use Spirit\ORM\Entity\Persist\Schedule;

class EntityManager implements EntityManagerInterface
{

    private Connection $connection;
    /** @var PersistSchedule<string,Schedule>> */
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
        $diagram = new EntityDiagram($this);
        $describer->describe($diagram);
        $id = spl_object_hash($object);
        $this->scheduler->schedule($id, $object, self::STATE_NEW, $diagram);
    }

    public function flush(): void
    {
        // On démarre la transaction
        // On exécute toutes les requêtes programmées
        // On commit la transaction
        $this->connection->createTransaction(function (Connection $connection) {
            /** @var Schedule $scheduledQuery */
            foreach ($this->scheduler as $scheduledQuery) {
                /** @var PersistRequest $request */
                $request = $scheduledQuery->getRequest();
                $statement = $request->getPreparedStatement();
                if ($statement === null) {
                    throw new EntityManagerException("Impossible de préparer la requête");
                }
                $connection->execute($statement, $scheduledQuery->getParameters());
            }
        });
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
