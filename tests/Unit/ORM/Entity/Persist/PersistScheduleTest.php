<?php


namespace Spirit\Test\ORM\Entity\Persist;


use PHPUnit\Framework\TestCase;
use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagram;
use Spirit\ORM\Entity\Persist\PersistRequest;
use Spirit\ORM\Entity\Persist\PersistSchedule;
use Spirit\ORM\Entity\Persist\Schedule;
use Spirit\Test\Entity\SimpleEntity;
use Spirit\Test\Entity\SimpleEntityDescriber;

class PersistScheduleTest extends TestCase
{

    public function testScheduleInsertEntity(): void
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $scheduler = new PersistSchedule($em);
        $diagram = new EntityDiagram();
        $describer = new SimpleEntityDescriber();
        $describer->describe($diagram);

        $entity = new SimpleEntity();
        $objectId = spl_object_hash($entity);

        $scheduler->schedule($objectId, $entity, EntityManagerInterface::STATE_NEW, $diagram);

        // Le test
        $reflection = new \ReflectionClass(PersistSchedule::class);
        $reflectionProperty = $reflection->getProperty('schedules');
        $reflectionProperty->setAccessible(true);
        $schedules = $reflectionProperty->getValue($scheduler);
        /** @var Schedule $schedule */
        $schedule = $schedules[$objectId];
        /** @var PersistRequest $request */
        $request = $schedule->getRequest();
        $this->assertNotEmpty($schedules);
        $this->assertInstanceOf(PersistRequest::class, $request);
        $this->assertEquals("INSERT INTO simple (id, name) VALUES (?, ?);", $request->getQuery());
    }
}