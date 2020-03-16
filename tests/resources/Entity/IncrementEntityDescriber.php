<?php


namespace Spirit\Test\Entity;


use Spirit\ORM\Entity\Mapping\EntityDescriberInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagramInterface;

class IncrementEntityDescriber implements EntityDescriberInterface
{

    public function describe(EntityDiagramInterface $diagram): void
    {
        $diagram
            ->setEntity(SimpleEntity::class)
            ->setTableName("simple")
            ->increment('id')
            ->addField('name', 'string');
    }
}