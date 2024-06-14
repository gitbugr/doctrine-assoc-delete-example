<?php

namespace Test\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class ThingB extends AbstractThing
{
    #[ORM\ManyToOne(targetEntity: UserB::class, inversedBy: 'things')]
    protected UserB $owner;

    public function getOwner(): UserB
    {
        return $this->owner;
    }

    public function setOwner(UserB $owner): void
    {
        $this->owner = $owner;
    }
}
