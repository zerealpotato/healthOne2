<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="text")
     */
    private $adress;

    /**
     * @ORM\Column(type="text")
     */
    private $insuranceType;

    /**
     * @ORM\OneToMany(targetEntity=Recept::class, mappedBy="patient", orphanRemoval=true)
     */
    private $Recept;

    public function __construct()
    {
        $this->Recept = new ArrayCollection();
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

    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getInsuranceType(): ?string
    {
        return $this->insuranceType;
    }

    public function setInsuranceType(string $insuranceType): self
    {
        $this->insuranceType = $insuranceType;

        return $this;
    }

    /**
     * @return Collection|Recept[]
     */
    public function getRecept(): Collection
    {
        return $this->Recept;
    }

    public function addRecept(Recept $recept): self
    {
        if (!$this->Recept->contains($recept)) {
            $this->Recept[] = $recept;
            $recept->setPatient($this);
        }

        return $this;
    }

    public function removeRecept(Recept $recept): self
    {
        if ($this->Recept->removeElement($recept)) {
            // set the owning side to null (unless already changed)
            if ($recept->getPatient() === $this) {
                $recept->setPatient(null);
            }
        }

        return $this;
    }
}
