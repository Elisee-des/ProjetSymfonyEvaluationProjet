<?php

namespace App\Entity;

use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputRepository::class)]
class Input
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'inputs')]
    #[ORM\JoinColumn(nullable: false)]
    private $projet;

    #[ORM\OneToOne(mappedBy: 'input', targetEntity: InputReponse::class, cascade: ['persist', 'remove'])]
    private $inputReponse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getInputReponse(): ?InputReponse
    {
        return $this->inputReponse;
    }

    public function setInputReponse(?InputReponse $inputReponse): self
    {
        // unset the owning side of the relation if necessary
        if ($inputReponse === null && $this->inputReponse !== null) {
            $this->inputReponse->setInput(null);
        }

        // set the owning side of the relation if necessary
        if ($inputReponse !== null && $inputReponse->getInput() !== $this) {
            $inputReponse->setInput($this);
        }

        $this->inputReponse = $inputReponse;

        return $this;
    }

}
