<?php

namespace App\Entity;

use App\Repository\InputReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputReponseRepository::class)]
class InputReponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $reponse;

    #[ORM\ManyToOne(targetEntity: Reponse::class, inversedBy: 'inputs')]
    #[ORM\JoinColumn(nullable: false)]
    private $reponses;

    #[ORM\OneToOne(inversedBy: 'inputReponse', targetEntity: Input::class, cascade: ['persist', 'remove'])]
    private $input;

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

    public function getInput(): ?Input
    {
        return $this->input;
    }

    public function setInput(?Input $input): self
    {
        $this->input = $input;

        return $this;
    }
}
