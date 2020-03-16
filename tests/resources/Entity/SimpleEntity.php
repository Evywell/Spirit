<?php

namespace Spirit\Test\Entity;

class SimpleEntity
{

    private int $id;
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

}