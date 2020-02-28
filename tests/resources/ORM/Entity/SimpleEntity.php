<?php

namespace Spirit\Test\ORM\Entity;

class SimpleEntity
{

    private int $id;
    private string $name;

    /**
     * @param mixed $name
     * @return SimpleEntity
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}