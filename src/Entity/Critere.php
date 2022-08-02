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

    #[ORM\OneToMany(mappedBy: 'critere', targetEntity: Input::class, orphanRemoval: true)]
    private $input;

    #[ORM\OneToMany(mappedBy: 'critere', targetEntity: Checkbox::class, orphanRemoval: true)]
    private $checkboxs;

    #[ORM\OneToMany(mappedBy: 'critere', targetEntity: Radio::class, orphanRemoval: true)]
    private $radio;

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

    /**
     * @return Collection<int, Input>
     */
    public function getInput(): Collection
    {
        return $this->input;
    }

    public function addInput(Input $input): self
    {
        if (!$this->input->contains($input)) {
            $this->input[] = $input;
            $input->setCritere($this);
        }

        return $this;
    }

    public function removeInput(Input $input): self
    {
        if ($this->input->removeElement($input)) {
            // set the owning side to null (unless already changed)
            if ($input->getCritere() === $this) {
                $input->setCritere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Checkbox>
     */
    public function getCheckboxs(): Collection
    {
        return $this->checkboxs;
    }

    public function addCheckbox(Checkbox $checkbox): self
    {
        if (!$this->checkboxs->contains($checkbox)) {
            $this->checkboxs[] = $checkbox;
            $checkbox->setCritere($this);
        }

        return $this;
    }

    public function removeCheckbox(Checkbox $checkbox): self
    {
        if ($this->checkboxs->removeElement($checkbox)) {
            // set the owning side to null (unless already changed)
            if ($checkbox->getCritere() === $this) {
                $checkbox->setCritere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Radio>
     */
    public function getRadio(): Collection
    {
        return $this->radio;
    }

    public function addRadio(Radio $radio): self
    {
        if (!$this->radio->contains($radio)) {
            $this->radio[] = $radio;
            $radio->setCritere($this);
        }

        return $this;
    }

    public function removeRadio(Radio $radio): self
    {
        if ($this->radio->removeElement($radio)) {
            // set the owning side to null (unless already changed)
            if ($radio->getCritere() === $this) {
                $radio->setCritere(null);
            }
        }

        return $this;
    }
}
