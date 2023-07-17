<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 180, unique: true)]
  #[Assert\NotBlank(message: "L'email ne peut pas etre vide")]
  #[Assert\Email(message: "L'email n'est pas valide")]
  #[Assert\Regex(pattern: '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/', message: "L'email n'est pas valide")]

  private ?string $email = null;

  #[ORM\Column]
  private array $roles = [];

  /**
   * @var string The hashed password
   */
  #[ORM\Column]
  #[Assert\Length(min: 8, minMessage: "Le mot de passe doit contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre mot de passe doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', message: "Le mot de passe doit contenir au moin une majuscule, une minuscule, un chiffre et un caractere special")]
  private ?string $password = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le prénom ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le prénom doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre nom doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(pattern: '/^[a-zA-Z0-9]+$/', message: "Le prénom ne peut contenir que des lettres et des chiffres")]

  private ?string $firstName = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Le nom ne peut pas etre vide")]
  #[Assert\Length(min: 3, minMessage: " Le nom doit Contenir au moin {{Limit}} characteres", max: 255, maxMessage: "Votre nom doit contenir au maximum {{limit}} characteres")]
  #[Assert\Regex(pattern: '/^[a-zA-Z0-9]+$/', message: "Le nom ne peut contenir que des lettres et des chiffres")]

  private ?string $lastName = null;

  #[ORM\Column(length: 255, nullable: true)]
  #[Assert\Image(
    mimeTypes: [
      'image/jpeg', 'image/png', 'image/gif', 'image/webp'
    ],
    mimeTypesMessage: "Le format de l'image n'est pas valide",
    maxSize: '2M',
    maxSizeMessage: "L'image ne doit pas depasser {{limit}}"
  )]
  private ?string $profilPicture = null;


  public function getId(): ?int
  {
    return $this->id;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUserIdentifier(): string
  {
    return (string) $this->email;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  public function setRoles(array $roles): static
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials(): void
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
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

  public function getLastName(): ?string
  {
    return $this->lastName;
  }

  public function setLastName(string $lastName): static
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getProfilPicture(): ?string
  {
    return $this->profilPicture;
  }

  public function setProfilPicture(?string $profilPicture): static
  {
    $this->profilPicture = $profilPicture;

    return $this;
  }
}
