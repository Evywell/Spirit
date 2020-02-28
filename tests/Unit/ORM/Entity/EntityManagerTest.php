<?php

namespace Spirit\Test\ORM\Entity;

use PHPUnit\Framework\TestCase;

class EntityManagerTest extends TestCase
{

    public function testSchedulePersistEntity(): void
    {
        $object = new SimpleEntity();
        $object->setName("John");
    }

}