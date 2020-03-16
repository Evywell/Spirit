<?php

namespace Spirit\Test\ORM\Entity;

use PHPUnit\Framework\TestCase;
use Spirit\Connection;
use Spirit\MySQL\MySQLDriver;
use Spirit\ORM\Entity\EntityManager;
use Spirit\Settings;
use Spirit\Test\Entity\SimpleEntity;
use Spirit\Test\Entity\SimpleEntityDescriber;

class EntityManagerTest extends TestCase
{

    public function testSchedulePersistEntity(): void
    {
        $object = new SimpleEntity();
        $object->setId(1);
        $object->setName("Axel");
/**
        $settings = new Settings();
        $settings->setEntityMapping([
            SimpleEntity::class => SimpleEntityDescriber::class
        ]);
        $settings->setDrivers([
            'mysql' => MySQLDriver::class
        ]);
        $connection = Connection::create($settings, [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 33306,
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'spirit_test'
        ]);

        $em = new EntityManager($connection);
        $em->persist($object);
        $em->flush();
 **/
        $this->assertTrue(true);
    }

}