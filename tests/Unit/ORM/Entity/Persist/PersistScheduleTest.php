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
        $diagram = new EntityDiagram($em);
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

    public function testScheduleUsingCachedPersistRequest(): void
    {
        /** @var EntityManagerInterface $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $scheduler = new PersistSchedule($em);
        $diagram = new EntityDiagram($em);
        $describer = new SimpleEntityDescriber();
        $describer->describe($diagram);

        $entity1 = new SimpleEntity();
        $objectId1 = spl_object_hash($entity1);

        $entity2 = new SimpleEntity();
        $objectId2 = spl_object_hash($entity2);

        $scheduler->schedule($objectId1, $entity1, EntityManagerInterface::STATE_NEW, $diagram);
        $scheduler->schedule($objectId2, $entity2, EntityManagerInterface::STATE_NEW, $diagram);

        $reflection = new \ReflectionClass(PersistSchedule::class);
        $cacheProperty = $reflection->getProperty('persistRequestsCache');
        $cacheProperty->setAccessible(true);
        $this->assertCount(1, $cacheProperty->getValue($scheduler));

        $scheduleProperty = $reflection->getProperty('schedules');
        $scheduleProperty->setAccessible(true);
        $schedules = $scheduleProperty->getValue($scheduler);
        $this->assertCount(2, $schedules);

        $request1 = $schedules[spl_object_hash($entity1)];
        $request2 = $schedules[spl_object_hash($entity2)];

        $this->assertEquals($request1, $request2);
    }

}