<?php

namespace App\Entity;

use App\Repository\CheckboxReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckboxReponseRepository::class)]
class CheckboxReponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $reponse;

    #[ORM\ManyToOne(targetEntity: Reponse::class, inversedBy: 'checkboxs')]
    #[ORM\JoinColumn(nullable: false)]
    private $reponses;

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
}
