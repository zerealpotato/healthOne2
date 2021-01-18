<?php

namespace App\Entity;

use App\Repository\MedicijnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicijnRepository::class)
 */
class Medicijn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $discription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sideEffect;

    /**
     * @ORM\Column(type="boolean")
     */
    private $insurance;

    /**
     * @ORM\OneToMany(targetEntity=Recept::class, mappedBy="Medicijn")
     */
    private $recepts;

    public function __construct()
    {
        $this->recepts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(?string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function getSideEffect(): ?string
    {
        return $this->sideEffect;
    }

    public function setSideEffect(?string $sideEffect): self
    {
        $this->sideEffect = $sideEffect;

        return $this;
    }

    public function getInsurance(): ?bool
    {
        return $this->insurance;
    }

    public function setInsurance(bool $insurance): self
    {
        $this->insurance = $insurance;

        return $this;
    }

    /**
     * @return Collection|Recept[]
     */
    public function getRecepts(): Collection
    {
        return $this->recepts;
    }

    public function addRecept(Recept $recept): self
    {
        if (!$this->recepts->contains($recept)) {
            $this->recepts[] = $recept;
            $recept->setMedicijn($this);
        }

        return $this;
    }

    public function removeRecept(Recept $recept): self
    {
        if ($this->recepts->removeElement($recept)) {
            // set the owning side to null (unless already changed)
            if ($recept->getMedicijn() === $this) {
                $recept->setMedicijn(null);
            }
        }

        return $this;
    }
}
