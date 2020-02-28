<?php


namespace Spirit\Test\ORM\Entity;


use Spirit\ORM\Entity\EntityDescriberInterface;
use Spirit\ORM\Entity\EntityDiagramInterface;

class SimpleEntityDescriber implements EntityDescriberInterface
{

    public function describe(EntityDiagramInterface $diagram): void
    {
        $diagram
            ->setEntity(SimpleEntity::class)
            ->setTableName("simple")
            ->addField('id', 'integer')
            ->addField('name', 'string');
    }
}