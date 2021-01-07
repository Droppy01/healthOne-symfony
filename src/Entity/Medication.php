<?php

namespace App\Entity;

use App\Repository\MedicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicationRepository::class)
 */
class Medication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $pharmaceuticalCompany;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $insured;

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

    public function getPharmaceuticalCompany(): ?string
    {
        return $this->pharmaceuticalCompany;
    }

    public function setPharmaceuticalCompany(string $pharmaceuticalCompany): self
    {
        $this->pharmaceuticalCompany = $pharmaceuticalCompany;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getInsured(): ?bool
    {
        return $this->insured;
    }

    public function setInsured(bool $insured): self
    {
        $this->insured = $insured;

        return $this;
    }
}
