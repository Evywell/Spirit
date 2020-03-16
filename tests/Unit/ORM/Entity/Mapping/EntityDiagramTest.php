<?php


namespace Spirit\Test\ORM\Entity\Mapping;


use PHPUnit\Framework\TestCase;
use Spirit\ORM\Entity\EntityManagerInterface;
use Spirit\ORM\Entity\Mapping\EntityDiagram;
use Spirit\ORM\Entity\Mapping\Field\IncrementType;
use Spirit\ORM\Entity\Mapping\MappingTypeHandler;

class EntityDiagramTest extends TestCase
{

    public function testAddIncrementField(): void
    {
        $typeHandler = new MappingTypeHandler();
        $typeHandler->append(new IncrementType());
        $em = $this->createMock(EntityManagerInterface::class);
        $diagram = new EntityDiagram($em, $typeHandler);
        $diagram->addField('id', 'integer', ['extra' => 'AUTO_INCREMENT']);
        $diagram->addField('name', 'string');
        $fields = $diagram->getWritableFields();
        $this->assertCount(1, $fields);
        $this->assertEquals('name', $fields[0]->getFieldName());
    }

}