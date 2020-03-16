<?php


namespace Spirit\Test\Accessor;


use PHPUnit\Framework\TestCase;
use Spirit\Tools\Accessor\ObjectAccessor;

class ObjectAccessorTest extends TestCase
{

    public function testReturnPropertyValue(): void
    {
        $class = new SimpleClass();
        $accessor = new ObjectAccessor($class);
        $this->assertEquals("Hey you !", $accessor->getPropertyValue("publicProperty"));
        $this->assertEquals("hello", $accessor->getPropertyValue("myProperty"));
        $this->assertEquals(1, $accessor->getPropertyValue("a"));

        $class2 = new ExtendedClass();
        $accessor = new ObjectAccessor($class2);
        $this->assertEquals(2, $accessor->getPropertyValue("a"));
        $this->assertEquals(3, $accessor->getPropertyValue("b"));
        $this->assertEquals("Hey you !", $accessor->getPropertyValue("publicProperty"));
    }

}