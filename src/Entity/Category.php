<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le nom ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le nom doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre nom doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(
    pattern: '/^[a-zA-Z]+$/',
    message: "Le nom ne peut contenir que des lettres et des chiffres"
  )]
  private ?string $name = null;

  #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'categories')]

  private Collection $movie;

  public function __construct()
  {
    $this->movie = new ArrayCollection();
  }

  public function __toString()
  {
    return $this->name;
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

  /**
   * @return Collection<int, Movie>
   */
  public function getMovie(): Collection
  {
    return $this->movie;
  }

  public function addMovie(Movie $movie): static
  {
    if (!$this->movie->contains($movie)) {
      $this->movie->add($movie);
      $movie->addCategory($this);
    }

    return $this;
  }

  public function removeMovie(Movie $movie): static
  {
    $this->movie->removeElement($movie);

    return $this;
  }
}
