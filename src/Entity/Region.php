<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Vignoble::class, mappedBy="region" )
     */
    private $vignobles;

    /**
     * @ORM\ManyToMany(targetEntity=Grape::class, mappedBy="regions")
     */
    private $grapes;

    /**
     * @ORM\OneToMany(targetEntity=Wine::class, mappedBy="region")
     */
    private $wines;

    public function __construct()
    {
        $this->vignobles = new ArrayCollection();
        $this->grapes = new ArrayCollection();
        $this->wines = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Vignoble[]
     */
    public function getVignobles(): Collection
    {
        return $this->vignobles;
    }

    public function addVignoble(Vignoble $vignoble): self
    {
        if (!$this->vignobles->contains($vignoble)) {
            $this->vignobles[] = $vignoble;
            $vignoble->setRegion($this);
        }

        return $this;
    }

    public function removeVignoble(Vignoble $vignoble): self
    {
        if ($this->vignobles->removeElement($vignoble)) {
            // set the owning side to null (unless already changed)
            if ($vignoble->getRegion() === $this) {
                $vignoble->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grape[]
     */
    public function getGrapes(): Collection
    {
        return $this->grapes;
    }

    public function addGrape(Grape $grape): self
    {
        if (!$this->grapes->contains($grape)) {
            $this->grapes[] = $grape;
            $grape->addRegion($this);
        }

        return $this;
    }

    public function removeGrape(Grape $grape): self
    {
        if ($this->grapes->removeElement($grape)) {
            $grape->removeRegion($this);
        }

        return $this;
    }

    /**
     * @return Collection|Wine[]
     */
    public function getWines(): Collection
    {
        return $this->wines;
    }

    public function addWine(Wine $wine): self
    {
        if (!$this->wines->contains($wine)) {
            $this->wines[] = $wine;
            $wine->setRegion($this);
        }

        return $this;
    }

    public function removeWine(Wine $wine): self
    {
        if ($this->wines->removeElement($wine)) {
            // set the owning side to null (unless already changed)
            if ($wine->getRegion() === $this) {
                $wine->setRegion(null);
            }
        }

        return $this;
    }
}
