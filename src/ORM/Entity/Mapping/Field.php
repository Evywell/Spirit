<?php


namespace Spirit\ORM\Entity\Mapping;

class Field
{

    private string $type;
    private string $columnName;
    /** @var array<string,mixed> */
    private array $options;

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setColumnName(string $columnName): self
    {
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * @param array<string,mixed> $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }
}
