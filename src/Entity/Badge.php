<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BadgeRepository::class)
 */
class Badge
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bienvenue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pionnier;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mesure;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mensuration;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, inversedBy="badge", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBienvenue(): ?bool
    {
        return $this->bienvenue;
    }

    public function setBienvenue(bool $bienvenue): self
    {
        $this->bienvenue = $bienvenue;

        return $this;
    }

    public function getPionnier(): ?bool
    {
        return $this->pionnier;
    }

    public function setPionnier(bool $pionnier): self
    {
        $this->pionnier = $pionnier;

        return $this;
    }

    public function getMesure(): ?bool
    {
        return $this->mesure;
    }

    public function setMesure(bool $mesure): self
    {
        $this->mesure = $mesure;

        return $this;
    }

    public function getMensuration(): ?bool
    {
        return $this->mensuration;
    }

    public function setMensuration(bool $mensuration): self
    {
        $this->mensuration = $mensuration;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
