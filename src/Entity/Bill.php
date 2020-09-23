<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Bill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="bills")
     */
    private $company;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cratedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=BillStatus::class, inversedBy="bills")
     */
    private $status;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * @Assert\Positive
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceEuro(): ?int
    {
        return $this->priceEuro;
    }

    public function setPriceEuro(?int $priceEuro): self
    {
        $this->priceEuro = $priceEuro;

        return $this;
    }

    public function getPriceCent(): ?int
    {
        return $this->priceCent;
    }

    public function setPriceCent(?int $priceCent): self
    {
        $this->priceCent = $priceCent;

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

    public function getCratedAt(): ?\DateTimeInterface
    {
        return $this->cratedAt;
    }

    public function setCratedAt(?\DateTimeInterface $cratedAt): self
    {
        $this->cratedAt = $cratedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /** 
     * @ORM\PrePersist
     */
    public function generateCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /** 
     * @ORM\PreUpdate
     */
    public function generateUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getStatus(): ?BillStatus
    {
        return $this->status;
    }

    public function setStatus(?BillStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
