<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le titre ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le titre doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre titre doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(
    pattern: '/^[a-zA-Z0-9]+$/',
    message: "Le titre ne peut contenir que des lettres et des chiffres"
  )]

  private ?string $title = null;

  #[ORM\Column(length: 255, nullable: true)]
  #[Assert\Length(min: 3, minMessage: " La description doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre description doit contenir au maximum {{limit}} characteres")]
  private ?string $description = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  #[Assert\NotBlank(message: "La date de sortie ne peut pas etre vide")]

  private ?\DateTimeInterface $releaseYear = null;

  #[ORM\Column]
  #[Assert\NotBlank(message: "La durée ne peut pas etre vide")]
  #[Assert\Positive(message: "La durée doit etre un nombre positif")]

  private ?float $duration = null;


  #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'movie')]

  private Collection $actors;

  #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'movie')]
  private Collection $categories;

  #[ORM\ManyToMany(targetEntity: Realisator::class, inversedBy: 'movie')]
  private Collection $realisators;

  public function __construct()
  {
    $this->actors = new ArrayCollection();
    $this->categories = new ArrayCollection();
    $this->realisators = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): static
  {
    $this->title = $title;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(?string $description): static
  {
    $this->description = $description;

    return $this;
  }

  public function getReleaseYear(): ?\DateTimeInterface
  {
    return $this->releaseYear;
  }

  public function setReleaseYear(\DateTimeInterface $releaseYear): static
  {
    $this->releaseYear = $releaseYear;

    return $this;
  }

  public function getDuration(): ?float
  {
    return $this->duration;
  }

  public function setDuration(float $duration): static
  {
    $this->duration = $duration;

    return $this;
  }

  /**
   * @return Collection<int, Actor>
   */
  public function getActors(): Collection
  {
    return $this->actors;
  }

  public function addActor(Actor $actor): static
  {
    if (!$this->actors->contains($actor)) {
      $this->actors->add($actor);
    }

    return $this;
  }

  public function removeActor(Actor $actor): static
  {
    if ($this->actors->removeElement($actor)) {
      $actor->removeMovie($this);
    }

    return $this;
  }

  /**
   * @return Collection<int, Category>
   */
  public function getCategories(): Collection
  {
    return $this->categories;
  }

  public function addCategory(Category $category): static
  {
    if (!$this->categories->contains($category)) {
      $this->categories->add($category);
    }

    return $this;
  }

  public function removeCategory(Category $category): static
  {
    if ($this->categories->removeElement($category)) {
      $category->removeMovie($this);
    }

    return $this;
  }

  /**
   * @return Collection<int, Realisator>
   */
  public function getRealisators(): Collection
  {
    return $this->realisators;
  }

  public function addRealisator(Realisator $realisator): static
  {
    if (!$this->realisators->contains($realisator)) {
      $this->realisators->add($realisator);
    }

    return $this;
  }

  public function removeRealisator(Realisator $realisator): static
  {
    if ($this->realisators->removeElement($realisator)) {
      $realisator->removeMovie($this);
    }

    return $this;
  }
}
