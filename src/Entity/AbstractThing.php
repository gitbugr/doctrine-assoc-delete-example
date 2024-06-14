<?php

namespace Test\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'things')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string', length: 1)]
#[ORM\DiscriminatorMap(['a' => 'ThingA', 'b' => 'ThingB'])]
#[ORM\Entity()]
abstract class AbstractThing
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    protected int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
