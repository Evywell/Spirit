<?php

namespace Spirit\ORM\Entity\Mapping\Field;

use Spirit\ORM\Entity\Mapping\Field;
use Spirit\ORM\Entity\Mapping\MappingTypeInterface;

class IncrementType implements MappingTypeInterface
{

    /**
     * @inheritDoc
     */
    public function canManage(string $type, array $options): bool
    {
        return $type === 'integer' &&
            array_key_exists('extra', $options) &&
            strtoupper($options['extra']) === 'AUTO_INCREMENT';
    }

    /**
     * @inheritDoc
     */
    public function process(string $fieldName, string $type, array $options = []): Field
    {
        return new Increment();
    }
}
