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

    #[ORM\Column(type: 'text')]
    private $input;

    #[ORM\OneToMany(mappedBy: 'reponse', targetEntity: Input::class)]
    private $inputs;

    #[ORM\OneToMany(mappedBy: 'reponse', targetEntity: Radio::class)]
    private $radios;

    #[ORM\OneToMany(mappedBy: 'reponse', targetEntity: Checkbox::class)]
    private $checkboxs;

    public function __construct()
    {
        $this->inputs = new ArrayCollection();
        $this->radios = new ArrayCollection();
        $this->checkboxs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): self
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @return Collection<int, Input>
     */
    public function getInputs(): Collection
    {
        return $this->inputs;
    }

    public function addInput(Input $input): self
    {
        if (!$this->inputs->contains($input)) {
            $this->inputs[] = $input;
            $input->setReponse($this);
        }

        return $this;
    }

    public function removeInput(Input $input): self
    {
        if ($this->inputs->removeElement($input)) {
            // set the owning side to null (unless already changed)
            if ($input->getReponse() === $this) {
                $input->setReponse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Radio>
     */
    public function getRadios(): Collection
    {
        return $this->radios;
    }

    public function addRadio(Radio $radio): self
    {
        if (!$this->radios->contains($radio)) {
            $this->radios[] = $radio;
            $radio->setReponse($this);
        }

        return $this;
    }

    public function removeRadio(Radio $radio): self
    {
        if ($this->radios->removeElement($radio)) {
            // set the owning side to null (unless already changed)
            if ($radio->getReponse() === $this) {
                $radio->setReponse(null);
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
            $checkbox->setReponse($this);
        }

        return $this;
    }

    public function removeCheckbox(Checkbox $checkbox): self
    {
        if ($this->checkboxs->removeElement($checkbox)) {
            // set the owning side to null (unless already changed)
            if ($checkbox->getReponse() === $this) {
                $checkbox->setReponse(null);
            }
        }

        return $this;
    }
}
