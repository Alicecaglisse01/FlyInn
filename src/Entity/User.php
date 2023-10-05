<?php

// src/Entity/User.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ApiResource]
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="utilisateurs")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="ID_Utilisateur")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="Nom")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, name="Prenom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, name="Email", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, name="MotDePasse")
     */
    private $motDePasse;

    /**
     * @ORM\Column(type="string", length=255, name="Role")
     */
    private $role;

    /**
     * @ORM\Column(type="text", name="AutresInformations", nullable=true)
     */
    private $autresInformations;

    /**
     * @ORM\Column(type="date", name="ddn", nullable=true)
     */
    private $ddn;

    // ... getters, setters, and UserInterface methods

    public function getRoles(): array
    {
        // Par exemple, vous pouvez simplement retourner un tableau de rôles
        // Vous voudrez peut-être ajuster cette logique en fonction de votre application
        return ['ROLE_USER'];
    }



    public function getPassword(): ?string
    {
        return $this->motDePasse;
    }

    public function getSalt(): ?string
    {
        // Symfony recommande d'utiliser bcrypt, qui n'a pas besoin de salt
        return null;
    }

    public function eraseCredentials(): void
    {
        // Cette méthode est utilisée pour effacer les données sensibles de l'objet utilisateur
        // Dans cet exemple, il n'y a rien à effacer
    }

    public function getUserIdentifier(): string
    {
        // Cette méthode devrait retourner un identifiant unique pour l'utilisateur, comme l'email
        return $this->email;
    }

    public function getDdn(): ?\DateTimeInterface
    {
        return $this->ddn;
    }

    public function setDdn(?\DateTimeInterface $ddn): self
    {
        $this->ddn = $ddn;

        return $this;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
    // src/Entity/User.php

    // ... autres propriétés et méthodes

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    // ... autres getters et setters

}
