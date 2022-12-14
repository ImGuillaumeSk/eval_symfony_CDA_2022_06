<?php

namespace App\Entity;

use App\Repository\ComputerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerRepository::class)]
class Computer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $anneeSortie = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $is_visible = null;

    #[ORM\ManyToOne(inversedBy: 'brandComputers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $marque = null;

    #[ORM\Column(length: 5)]
    private ?string $numeroSerie = null;

    #[ORM\ManyToOne(inversedBy: 'computers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $auteur = null;

    #[ORM\OneToMany(mappedBy: 'computers', targetEntity: ComputerListByUser::class)]
    private Collection $usersFav;

    public function __construct()
    {
        $this->usersFav = new ArrayCollection();
    }

    #[ORM\ManyToOne(inversedBy: 'computerList')]
    #[ORM\JoinColumn(nullable: false)]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAnneeSortie(): ?int
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(int $anneeSortie): self
    {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isIsVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): self
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    public function getMarque(): ?Brand
    {
        return $this->marque;
    }

    public function setMarque(?Brand $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection<int, ComputerListByUser>
     */
    public function getUsersFav(): Collection
    {
        return $this->usersFav;
    }

    public function addUsersFav(ComputerListByUser $usersFav): self
    {
        if (!$this->usersFav->contains($usersFav)) {
            $this->usersFav->add($usersFav);
            $usersFav->setComputers($this);
        }

        return $this;
    }

    public function removeUsersFav(ComputerListByUser $usersFav): self
    {
        if ($this->usersFav->removeElement($usersFav)) {
            // set the owning side to null (unless already changed)
            if ($usersFav->getComputers() === $this) {
                $usersFav->setComputers(null);
            }
        }

        return $this;
    }

    /**
     *
     * @param User $user
     * @return boolean
     */
    public function isUserfav(User $user): bool
    {
        foreach ($this->usersFav as $usersFav) {
            if ($usersFav->getUsers() === $user) return true;
        }
        return false;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(string $numeroSerie): self
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }
}
