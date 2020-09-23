<?php

namespace Spirit\ORM\Entity\Persist;

use Spirit\Tools\Accessor\ObjectAccessor;

class FieldValueResolver
{

    /**
     * @param string $fieldName
     * @param object $entity
     * @return mixed
     * @throws \ReflectionException
     * @throws \Spirit\Tools\Accessor\ObjectAccessorException
     */
    public function resolve(string $fieldName, object $entity)
    {
        $accessor = new ObjectAccessor($entity);
        return $accessor->getPropertyValue($fieldName);
    }
}
