<?php

namespace Test\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Table(name: 'useras')]
#[ORM\Entity()]
class UserA
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    protected int $id;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: ThingA::class, orphanRemoval: true)]
    protected Collection $things;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThings(): Collection
    {
        return $this->things;
    }

    public function setThings(Collection $things): void
    {
        $this->things = $things;
    }
}
