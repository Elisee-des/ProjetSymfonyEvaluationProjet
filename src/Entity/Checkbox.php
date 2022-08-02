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

    #[ORM\ManyToOne(targetEntity: Critere::class, inversedBy: 'checkboxs')]
    #[ORM\JoinColumn(nullable: false)]
    private $critere;

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

    public function getCritere(): ?Critere
    {
        return $this->critere;
    }

    public function setCritere(?Critere $critere): self
    {
        $this->critere = $critere;

        return $this;
    }
}
