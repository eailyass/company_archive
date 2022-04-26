<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["snapshot"])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["snapshot"])]
    private $name;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(["snapshot"])]
    private $immatriculationDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["snapshot"])]
    private $immatriculationCity;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["snapshot"])]
    private $siren;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(["snapshot"])]
    private $capital;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'companies')]
    #[Groups(["snapshot"])]
    private $status;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Address::class, orphanRemoval: true, cascade: ['persist'] )]
    #[Groups(["snapshot"])]
    private $addresses;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: CompanySnapshot::class, orphanRemoval: true)]
    private $companySnapshots;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->companySnapshots = new ArrayCollection();
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

    public function getImmatriculationDate(): ?\DateTimeInterface
    {
        return $this->immatriculationDate;
    }

    public function setImmatriculationDate(?\DateTimeInterface $immatriculationDate): self
    {
        $this->immatriculationDate = $immatriculationDate;

        return $this;
    }

    public function getImmatriculationCity(): ?string
    {
        return $this->immatriculationCity;
    }

    public function setImmatriculationCity(?string $immatriculationCity): self
    {
        $this->immatriculationCity = $immatriculationCity;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getCapital(): ?float
    {
        return $this->capital;
    }

    public function setCapital(?float $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCompany($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompany() === $this) {
                $address->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompanySnapshot>
     */
    public function getCompanySnapshots(): Collection
    {
        return $this->companySnapshots;
    }

    public function addCompanySnapshot(CompanySnapshot $companySnapshot): self
    {
        if (!$this->companySnapshots->contains($companySnapshot)) {
            $this->companySnapshots[] = $companySnapshot;
            $companySnapshot->setCompany($this);
        }

        return $this;
    }

    public function removeCompanySnapshot(CompanySnapshot $companySnapshot): self
    {
        if ($this->companySnapshots->removeElement($companySnapshot)) {
            // set the owning side to null (unless already changed)
            if ($companySnapshot->getCompany() === $this) {
                $companySnapshot->setCompany(null);
            }
        }

        return $this;
    }
}
