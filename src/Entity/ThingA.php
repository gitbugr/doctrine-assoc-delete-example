<?php

namespace Test\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class ThingA extends AbstractThing
{
    #[ORM\ManyToOne(targetEntity: UserA::class, inversedBy: 'things')]
    protected UserA $owner;

    public function getOwner(): UserA
    {
        return $this->owner;
    }

    public function setOwner(UserA $owner): void
    {
        $this->owner = $owner;
    }
}
