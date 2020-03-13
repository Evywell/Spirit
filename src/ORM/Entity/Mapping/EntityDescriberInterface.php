<?php

namespace Spirit\ORM\Entity\Mapping;

interface EntityDescriberInterface
{

    public function describe(EntityDiagramInterface $diagram): void;
}
