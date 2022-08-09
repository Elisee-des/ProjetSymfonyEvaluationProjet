<?php

namespace App\Entity;

use App\Repository\RadioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RadioRepository::class)]
class Radio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'string', length: 255)]
    private $radio;

    #[ORM\ManyToOne(targetEntity: Projet::class, inversedBy: 'radios')]
    #[ORM\JoinColumn(nullable: false)]
    private $projet;

    #[ORM\OneToOne(mappedBy: 'radio', targetEntity: RadioReponse::class, cascade: ['persist', 'remove'])]
    private $radioReponse;

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

    public function getRadio(): ?string
    {
        return $this->radio;
    }

    public function setRadio(string $radio): self
    {
        $this->radio = $radio;

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

    public function getRadioReponse(): ?RadioReponse
    {
        return $this->radioReponse;
    }

    public function setRadioReponse(?RadioReponse $radioReponse): self
    {
        // unset the owning side of the relation if necessary
        if ($radioReponse === null && $this->radioReponse !== null) {
            $this->radioReponse->setRadio(null);
        }

        // set the owning side of the relation if necessary
        if ($radioReponse !== null && $radioReponse->getRadio() !== $this) {
            $radioReponse->setRadio($this);
        }

        $this->radioReponse = $radioReponse;

        return $this;
    }

}
