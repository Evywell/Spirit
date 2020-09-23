<?php

namespace Spirit\ORM\Entity;

use Spirit\Connection;
use Spirit\ORM\Entity\Mapping\EntityMapper;

interface EntityManagerInterface
{

    public const STATE_NEW = 0;

    public function persist(object $object): void;

    public function flush(): void;

    public function getConnection(): Connection;

    public function getEntityMapper(): EntityMapper;
}
