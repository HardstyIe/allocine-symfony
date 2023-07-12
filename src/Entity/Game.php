<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $isEnable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $launchDate = null;

    #[ORM\Column]
    private ?bool $isOnline = null;

    #[ORM\Column]
    private ?bool $isMultiplayer = null;

    #[ORM\Column(nullable: true)]
    private ?int $minPlayerOffline = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxPlayerOffline = null;

    #[ORM\Column(nullable: true)]
    private ?int $minPlayerOnline = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxPlayerOnline = null;

    #[ORM\ManyToMany(targetEntity: Console::class, inversedBy: 'games')]
    private Collection $consoles;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'games')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Entreprise::class, inversedBy: 'games')]
    private Collection $entreprises;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'games')]
    private Collection $genres;

    public function __construct()
    {
        $this->consoles = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(bool $isEnable): static
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLaunchDate(): ?\DateTimeInterface
    {
        return $this->launchDate;
    }

    public function setLaunchDate(\DateTimeInterface $launchDate): static
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    public function isIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(bool $isOnline): static
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function isIsMultiplayer(): ?bool
    {
        return $this->isMultiplayer;
    }

    public function setIsMultiplayer(bool $isMultiplayer): static
    {
        $this->isMultiplayer = $isMultiplayer;

        return $this;
    }

    public function getMinPlayerOffline(): ?int
    {
        return $this->minPlayerOffline;
    }

    public function setMinPlayerOffline(?int $minPlayerOffline): static
    {
        $this->minPlayerOffline = $minPlayerOffline;

        return $this;
    }

    public function getMaxPlayerOffline(): ?int
    {
        return $this->maxPlayerOffline;
    }

    public function setMaxPlayerOffline(?int $maxPlayerOffline): static
    {
        $this->maxPlayerOffline = $maxPlayerOffline;

        return $this;
    }

    public function getMinPlayerOnline(): ?int
    {
        return $this->minPlayerOnline;
    }

    public function setMinPlayerOnline(?int $minPlayerOnline): static
    {
        $this->minPlayerOnline = $minPlayerOnline;

        return $this;
    }

    public function getMaxPlayerOnline(): ?int
    {
        return $this->maxPlayerOnline;
    }

    public function setMaxPlayerOnline(?int $maxPlayerOnline): static
    {
        $this->maxPlayerOnline = $maxPlayerOnline;

        return $this;
    }

    /**
     * @return Collection<int, Console>
     */
    public function getConsoles(): Collection
    {
        return $this->consoles;
    }

    public function addConsole(Console $console): static
    {
        if (!$this->consoles->contains($console)) {
            $this->consoles->add($console);
        }

        return $this;
    }

    public function removeConsole(Console $console): static
    {
        $this->consoles->removeElement($console);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        $this->entreprises->removeElement($entreprise);

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addGames($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeGames($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }


}
