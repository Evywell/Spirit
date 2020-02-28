<?php

namespace Spirit\Test\ORM\Entity;

use PHPUnit\Framework\TestCase;
use Spirit\ORM\Entity\EntityManager;

class EntityManagerTest extends TestCase
{

    public function testSchedulePersistEntity(): void
    {
        $em = new EntityManager();
        $object = new SimpleEntity();
        $object->setName("John");
        $em->persist($object);
    }

}