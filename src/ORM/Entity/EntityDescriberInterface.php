<?php

namespace Spirit\ORM\Entity;

interface EntityDescriberInterface
{

    public function describe(EntityDiagramInterface $diagram): void;
}
