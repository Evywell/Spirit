<?php

namespace Spirit\Test\ORM\Entity;

use PHPUnit\Framework\TestCase;
use Spirit\Test\Entity\SimpleEntity;

class EntityManagerTest extends TestCase
{

    public function testSchedulePersistEntity(): void
    {
        $object = new SimpleEntity();
        $object->setName("John");
        $this->assertTrue(true);
    }

}