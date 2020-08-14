<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
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
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priceEuro;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $priceCent;

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
}
