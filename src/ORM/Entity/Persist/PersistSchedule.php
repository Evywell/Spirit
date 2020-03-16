<?php


namespace Spirit\ORM\Entity\Persist;

use Spirit\Exception\SpiritException;
use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagramInterface;

class PersistSchedule implements \IteratorAggregate
{

    /**
     * @var array<string,Schedule>
     */
    private array $schedules = [];
    private EntityManagerInterface $manager;
    /**
     * @var array<string,PersistRequest>
     */
    private array $persistRequestsCache = [];

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $id Le hash de l'objet
     * @param object $entity
     * @param int $state L'état de l'entité (constantes STATE_ dans l'EntityManager)
     * @param EntityDiagramInterface $diagram
     * @throws \Spirit\Exception\PersistScheduleException
     */
    public function schedule(string $id, object $entity, int $state, EntityDiagramInterface $diagram): void
    {
        switch ($state) {
            case EntityManagerInterface::STATE_NEW:
                // Dans le cas d'une nouvelle entité, il faut faire une requête d'insertion
                // On enregistre donc une requête INSERT avec les paramètres à enregistrer
                if (array_key_exists($id, $this->schedules) && $state !== $this->schedules[$id]->getState()) {
                    throw SpiritException::alreadyPersistingWithAnOtherState(get_class($entity));
                }
                // A-t-on déjà créé une PersistRequest de ce type d'entité ?
                $entityClassName = get_class($entity);
                if (array_key_exists($entityClassName, $this->persistRequestsCache)) {
                    $request = $this->persistRequestsCache[$entityClassName];
                } else {
                    $request = new PersistRequest($this->manager, $diagram, $diagram->getWritableFields());
                    $this->persistRequestsCache[$entityClassName] = $request;
                }

                $this->schedules[$id] = new Schedule($entity, $request, $state);
                break;
        }
    }

    /**
     * @return \Traversable<string,Schedule>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->schedules);
    }
}
