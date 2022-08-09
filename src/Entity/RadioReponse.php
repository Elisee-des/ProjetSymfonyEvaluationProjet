<?php

namespace App\Entity;

use App\Repository\RadioReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RadioReponseRepository::class)]
class RadioReponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $reponse;

    #[ORM\ManyToOne(targetEntity: Reponse::class, inversedBy: 'radios')]
    #[ORM\JoinColumn(nullable: false)]
    private $reponses;

    #[ORM\OneToOne(inversedBy: 'radioReponse', targetEntity: Radio::class, cascade: ['persist', 'remove'])]
    private $radio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getReponses(): ?Reponse
    {
        return $this->reponses;
    }

    public function setReponses(?Reponse $reponses): self
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getRadio(): ?Radio
    {
        return $this->radio;
    }

    public function setRadio(?Radio $radio): self
    {
        $this->radio = $radio;

        return $this;
    }
}
