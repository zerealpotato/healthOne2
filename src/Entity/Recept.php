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
    private $doce;

    /**
     * @ORM\Column(type="integer")
     */
    private $duur;

    /**
     * @ORM\ManyToOne(targetEntity=Medicijn::class, inversedBy="recepts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Medicijn;

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

    public function getDoce(): ?int
    {
        return $this->doce;
    }

    public function setDoce(int $doce): self
    {
        $this->doce = $doce;

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
}
