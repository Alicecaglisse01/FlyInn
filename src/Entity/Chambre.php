<?php
// src/Entity/Chambre.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
/**
 * @ORM\Entity(repositoryClass="App\Repository\ChambreRepository")
 * @ORM\Table(name="chambres")
 */
class Chambre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="ID_Chambre")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="ID_Proprietaire", referencedColumnName="ID_Utilisateur")
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="string", length=255, name="TitreChambre")
     */
    private $titreChambre;

    /**
     * @ORM\Column(type="text", name="DescriptionChambre")
     */
    private $descriptionChambre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, name="PrixMensuel")
     */
    private $prixMensuel;

    /**
     * @ORM\Column(type="boolean", name="Disponibilite")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="text", name="AdresseChambre")
     */
    private $adresseChambre;

    /**
     * @ORM\Column(type="text", name="AutresInformations", nullable=true)
     */
    private $autresInformations;

    /**
     * @ORM\Column(type="string", length=255, name="Photo")
     */
    private $photo;

    // ... getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreChambre(): ?string
    {
        return $this->titreChambre;
    }

    public function setTitreChambre(string $titreChambre): self
    {
        $this->titreChambre = $titreChambre;
        return $this;
    }

    public function getDescriptionChambre(): ?string
    {
        return $this->descriptionChambre;
    }

    public function setDescriptionChambre(string $descriptionChambre): self
    {
        $this->descriptionChambre = $descriptionChambre;
        return $this;
    }

    public function getPrixMensuel(): ?string
    {
        return $this->prixMensuel;
    }

    public function setPrixMensuel(string $prixMensuel): self
    {
        $this->prixMensuel = $prixMensuel;
        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;
        return $this;
    }

    public function getAdresseChambre(): ?string
    {
        return $this->adresseChambre;
    }

    public function setAdresseChambre(string $adresseChambre): self
    {
        $this->adresseChambre = $adresseChambre;
        return $this;
    }

    public function getAutresInformations(): ?string
    {
        return $this->autresInformations;
    }

    public function setAutresInformations(?string $autresInformations): self
    {
        $this->autresInformations = $autresInformations;
        return $this;
    }
    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): self
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }
}
