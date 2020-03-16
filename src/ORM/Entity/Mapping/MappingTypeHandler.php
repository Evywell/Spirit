<?php


namespace Spirit\ORM\Entity\Mapping;

class MappingTypeHandler
{

    /**
     * @var array<MappingTypeInterface>
     */
    private array $handlers = [];

    public function append(MappingTypeInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * @param string $fieldName
     * @param string $type
     * @param array<string,mixed> $options
     * @return Field|null
     */
    public function process(string $fieldName, string $type, array $options = []): ?Field
    {
        if (empty($this->handlers)) {
            return null;
        }

        /** @var MappingTypeInterface $handler */
        foreach ($this->handlers as $handler) {
            if ($handler->canManage($type, $options)) {
                return $handler->process($fieldName, $type, $options);
            }
        }

        return null;
    }
}
