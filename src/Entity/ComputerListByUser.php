<?php

namespace App\Entity;

use App\Repository\ComputerListByUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerListByUserRepository::class)]
class ComputerListByUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'computerFav')]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'usersFav')]
    private ?Computer $computers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getComputers(): ?Computer
    {
        return $this->computers;
    }

    public function setComputers(?Computer $computers): self
    {
        $this->computers = $computers;

        return $this;
    }
}
