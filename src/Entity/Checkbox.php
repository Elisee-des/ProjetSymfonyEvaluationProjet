<?php

namespace App\Entity;

use App\Repository\CheckboxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckboxRepository::class)]
class Checkbox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'string', length: 255)]
    private $checkbox;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'checkboxs')]
    #[ORM\JoinColumn(nullable: false)]
    private $projet;

    #[ORM\ManyToOne(targetEntity: Reponse::class, inversedBy: 'checkboxs')]
    private $reponse;

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

    public function getCheckbox(): ?string
    {
        return $this->checkbox;
    }

    public function setCheckbox(string $checkbox): self
    {
        $this->checkbox = $checkbox;

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

    public function getReponse(): ?Reponse
    {
        return $this->reponse;
    }

    public function setReponse(?Reponse $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

}
