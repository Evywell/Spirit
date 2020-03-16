<?php


namespace Spirit\Tools\Accessor;

class ObjectAccessor
{

    private ?\ReflectionClass $reflection = null;
    private object $subject;

    public function __construct(object $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param string $propertyName
     * @return mixed
     * @throws \ReflectionException
     * @throws ObjectAccessorException
     */
    public function getPropertyValue(string $propertyName)
    {
        $reflection = $this->getReflection();
        if (!$reflection->hasProperty($propertyName)) {
            throw new ObjectAccessorException("La propriété $propertyName n'existe pas");
        }
        $property = $reflection->getProperty($propertyName);
        if ($property->isPublic()) {
            return $this->getPublicPropertyValue($property);
        }
        if ($property->isProtected() || $property->isPrivate()) {
            $property->setAccessible(true);
            return $this->getAccessiblePropertyValue($property);
        }
    }

    /**
     * @param \ReflectionProperty $property
     * @return mixed
     */
    private function getPublicPropertyValue(\ReflectionProperty $property)
    {
        return $this->getAccessiblePropertyValue($property);
    }

    /**
     * @param \ReflectionProperty $property
     * @return mixed
     */
    private function getAccessiblePropertyValue(\ReflectionProperty $property)
    {
        return $property->isStatic() ?
            $this->getReflection()->getStaticPropertyValue($property->getName()) :
            $property->getValue($this->subject);
    }

    private function getReflection(): \ReflectionClass
    {
        if ($this->reflection === null) {
            $this->reflection = new \ReflectionClass($this->subject);
        }

        return $this->reflection;
    }
}
