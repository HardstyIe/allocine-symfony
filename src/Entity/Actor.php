<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActorRepository::class)]

class Actor
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]

  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le prénom ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le prénom doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre nom doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(
    pattern: '/^[a-zA-Z0-9]+$/',
    message: "Le prénom ne peut contenir que des lettres et des chiffres"
  )]
  private ?string $firstName = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le nom ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le nom doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre nom doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(
    pattern: '/^[a-zA-Z0-9]+$/',
    message: "Le nom ne peut contenir que des lettres et des chiffres"
  )]
  private ?string $lastName = null;

  #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]

  private Collection $movie;


  public function __construct()
  {
    $this->movie = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFirstName(): ?string
  {
    return $this->firstName;
  }

  public function setFirstName(string $firstName): static
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function __toString()
  {
    return $this->firstName . ' ' . $this->lastName;
  }

  public function getLastName(): ?string
  {
    return $this->lastName;
  }

  public function setLastName(string $lastName): static
  {
    $this->lastName = $lastName;

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
    }

    return $this;
  }

  public function removeMovie(Movie $movie): static
  {
    $this->movie->removeElement($movie);

    return $this;
  }
}
