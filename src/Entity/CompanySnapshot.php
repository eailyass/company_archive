<?php

namespace App\Entity;

use App\Repository\CompanySnapshotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanySnapshotRepository::class)]
class CompanySnapshot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'json')]
    private $snapshot = [];

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'companySnapshots')]
    #[ORM\JoinColumn(nullable: false)]
    private $company;

    #[ORM\Column(type: 'datetime')]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSnapshot(): ?array
    {
        return $this->snapshot;
    }

    public function setSnapshot(array $snapshot): self
    {
        $this->snapshot = $snapshot;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
