<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $nombreEvaluateur;

    #[ORM\Column(type: 'datetime')]
    private $dateCreation;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'projet', orphanRemoval: true)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'projets', targetEntity: Critere::class)]
    private $criteres;

    #[ORM\Column(type: 'integer')]
    private $nombreInput;

    #[ORM\Column(type: 'integer')]
    private $nombreRadio;

    #[ORM\Column(type: 'integer')]
    private $nombreCheckbox;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Input::class, orphanRemoval: true)]
    private $inputs;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Radio::class, orphanRemoval: true)]
    private $radios;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Checkbox::class, orphanRemoval: true)]
    private $checkboxs;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->criteres = new ArrayCollection();
        $this->dateCreation = new DateTime();
        $this->inputs = new ArrayCollection();
        $this->radios = new ArrayCollection();
        $this->checkboxs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNombreEvaluateur(): ?int
    {
        return $this->nombreEvaluateur;
    }

    public function setNombreEvaluateur(int $nombreEvaluateur): self
    {
        $this->nombreEvaluateur = $nombreEvaluateur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addProjet($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeProjet($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Critere>
     */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Critere $critere): self
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres[] = $critere;
            $critere->setProjets($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): self
    {
        if ($this->criteres->removeElement($critere)) {
            // set the owning side to null (unless already changed)
            if ($critere->getProjets() === $this) {
                $critere->setProjets(null);
            }
        }

        return $this;
    }

    public function getNombreInput(): ?int
    {
        return $this->nombreInput;
    }

    public function setNombreInput(int $nombreInput): self
    {
        $this->nombreInput = $nombreInput;

        return $this;
    }

    public function getNombreRadio(): ?int
    {
        return $this->nombreRadio;
    }

    public function setNombreRadio(int $nombreRadio): self
    {
        $this->nombreRadio = $nombreRadio;

        return $this;
    }

    public function getnombreCheckbox(): ?int
    {
        return $this->nombreCheckbox;
    }

    public function setnombreCheckbox(int $nombreCheckbox): self
    {
        $this->nombreCheckbox = $nombreCheckbox;

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
            $input->setProjet($this);
        }

        return $this;
    }

    public function removeInput(Input $input): self
    {
        if ($this->inputs->removeElement($input)) {
            // set the owning side to null (unless already changed)
            if ($input->getProjet() === $this) {
                $input->setProjet(null);
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
            $radio->setProjet($this);
        }

        return $this;
    }

    public function removeRadio(Radio $radio): self
    {
        if ($this->radios->removeElement($radio)) {
            // set the owning side to null (unless already changed)
            if ($radio->getProjet() === $this) {
                $radio->setProjet(null);
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
            $checkbox->setProjet($this);
        }

        return $this;
    }

    public function removeCheckbox(Checkbox $checkbox): self
    {
        if ($this->checkboxs->removeElement($checkbox)) {
            // set the owning side to null (unless already changed)
            if ($checkbox->getProjet() === $this) {
                $checkbox->setProjet(null);
            }
        }

        return $this;
    }
}
