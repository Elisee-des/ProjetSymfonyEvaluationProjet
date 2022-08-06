<?php

namespace App\Entity;

use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CritereRepository::class)]
class Critere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'criteres')]
    #[ORM\JoinColumn(nullable: false)]
    private $projets;

    public function __construct()
    {
        $this->input = new ArrayCollection();
        $this->checkboxs = new ArrayCollection();
        $this->radio = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProjets(): ?Projet
    {
        return $this->projets;
    }

    public function setProjets(?Projet $projets): self
    {
        $this->projets = $projets;

        return $this;
    }

}
