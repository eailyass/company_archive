<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AddressRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["snapshot"])]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["snapshot"])]
    private $number;

    #[ORM\Column(type: 'smallint')]
    #[Groups(["snapshot"])]
    private $streetType;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["snapshot"])]
    private $streetName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["snapshot"])]
    private $city;

    #[ORM\Column(type: 'integer')]
    #[Groups(["snapshot"])]
    private $zipCode;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'addresses')]
    #[ORM\JoinColumn(nullable: false)]
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStreetType(): ?int
    {
        return $this->streetType;
    }

    public function setStreetType(int $streetType): self
    {
        $this->streetType = $streetType;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(?string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
