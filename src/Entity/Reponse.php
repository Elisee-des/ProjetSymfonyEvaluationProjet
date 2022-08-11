<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\OneToMany(mappedBy: 'reponses', targetEntity: InputReponse::class, orphanRemoval: true)]
    private $inputs;

    #[ORM\OneToMany(mappedBy: 'reponses', targetEntity: RadioReponse::class, orphanRemoval: true)]
    private $radios;

    #[ORM\OneToMany(mappedBy: 'reponses', targetEntity: CheckboxReponse::class, orphanRemoval: true)]
    private $checkboxs;

    public function __construct()
    {
        $this->inputs = new ArrayCollection();
        $this->radios = new ArrayCollection();
        $this->checkboxs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, InputReponse>
     */
    public function getInputs(): Collection
    {
        return $this->inputs;
    }

    public function addInput(InputReponse $input): self
    {
        if (!$this->inputs->contains($input)) {
            $this->inputs[] = $input;
            $input->setReponses($this);
        }

        return $this;
    }

    public function removeInput(InputReponse $input): self
    {
        if ($this->inputs->removeElement($input)) {
            // set the owning side to null (unless already changed)
            if ($input->getReponses() === $this) {
                $input->setReponses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RadioReponse>
     */
    public function getRadios(): Collection
    {
        return $this->radios;
    }

    public function addRadio(RadioReponse $radio): self
    {
        if (!$this->radios->contains($radio)) {
            $this->radios[] = $radio;
            $radio->setReponses($this);
        }

        return $this;
    }

    public function removeRadio(RadioReponse $radio): self
    {
        if ($this->radios->removeElement($radio)) {
            // set the owning side to null (unless already changed)
            if ($radio->getReponses() === $this) {
                $radio->setReponses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CheckboxReponse>
     */
    public function getCheckboxs(): Collection
    {
        return $this->checkboxs;
    }

    public function addCheckbox(CheckboxReponse $checkbox): self
    {
        if (!$this->checkboxs->contains($checkbox)) {
            $this->checkboxs[] = $checkbox;
            $checkbox->setReponses($this);
        }

        return $this;
    }

    public function removeCheckbox(CheckboxReponse $checkbox): self
    {
        if ($this->checkboxs->removeElement($checkbox)) {
            // set the owning side to null (unless already changed)
            if ($checkbox->getReponses() === $this) {
                $checkbox->setReponses(null);
            }
        }

        return $this;
    }
}
