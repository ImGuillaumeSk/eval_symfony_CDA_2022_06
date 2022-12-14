<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Computer::class)]
    private Collection $brandComputers;

    public function __construct()
    {
        $this->brandComputers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Computer>
     */
    public function getBrandComputers(): Collection
    {
        return $this->brandComputers;
    }

    public function addBrandComputer(Computer $brandComputer): self
    {
        if (!$this->brandComputers->contains($brandComputer)) {
            $this->brandComputers->add($brandComputer);
            $brandComputer->setMarque($this);
        }

        return $this;
    }

    public function removeBrandComputer(Computer $brandComputer): self
    {
        if ($this->brandComputers->removeElement($brandComputer)) {
            // set the owning side to null (unless already changed)
            if ($brandComputer->getMarque() === $this) {
                $brandComputer->setMarque(null);
            }
        }

        return $this;
    }
}
