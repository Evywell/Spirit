<?php

namespace Spirit\ORM\Entity;

interface EntityManagerInterface
{

    public function persist(object $object): void;

    public function flush(): void;

}
