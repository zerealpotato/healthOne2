<?php

namespace App\Entity;

use App\Repository\ReceptRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ReceptRepository::class)
 */
class Recept
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $dose;

    /**
     * @ORM\Column(type="integer")
     */
    private $duur;

    /**
     * @ORM\ManyToOne(targetEntity=Medicijn::class, inversedBy="recepts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Medicijn;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="Recept")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDose(): ?int
    {
        return $this->dose;
    }

    public function setDose(int $dose): self
    {
        $this->dose = $dose;

        return $this;
    }

    public function getDuur(): ?int
    {
        return $this->duur;
    }

    public function setDuur(int $duur): self
    {
        $this->duur = $duur;

        return $this;
    }

    public function getMedicijn(): ?Medicijn
    {
        return $this->Medicijn;
    }

    public function setMedicijn(?Medicijn $Medicijn): self
    {
        $this->Medicijn = $Medicijn;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
