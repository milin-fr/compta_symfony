<?php

namespace App\Entity;

use App\Repository\WorkTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WorkTypeRepository::class)
 */
class WorkType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Company::class, mappedBy="workType")
     */
    private $companies;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive
     */
    private $budgetEuro;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Range(
     *      min = "0",
     *      max = "99",
    *       notInRangeMessage = "La valeur doit est compris entre {{ min }} et {{ max }}",
     * )
     */
    private $budgetCent;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setWorkType($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getWorkType() === $this) {
                $company->setWorkType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getBudgetEuro(): ?int
    {
        return $this->budgetEuro;
    }

    public function setBudgetEuro(?int $budgetEuro): self
    {
        $this->budgetEuro = $budgetEuro;

        return $this;
    }

    public function getBudgetCent(): ?int
    {
        return $this->budgetCent;
    }

    public function setBudgetCent(?int $budgetCent): self
    {
        $this->budgetCent = $budgetCent;

        return $this;
    }
}
