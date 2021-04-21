<?php

namespace App\Entity;

use App\Repository\MensurationObjectifRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MensurationObjectifRepository::class)
 */
class MensurationObjectif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Cou;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Epaules;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Poitrine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Bras;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Tourdetaille;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Cuisses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Mollets;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="mensurationObjectifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCou(): ?int
    {
        return $this->Cou;
    }

    public function setCou(?int $Cou): self
    {
        $this->Cou = $Cou;

        return $this;
    }

    public function getEpaules(): ?int
    {
        return $this->Epaules;
    }

    public function setEpaules(?int $Epaules): self
    {
        $this->Epaules = $Epaules;

        return $this;
    }

    public function getPoitrine(): ?int
    {
        return $this->Poitrine;
    }

    public function setPoitrine(?int $Poitrine): self
    {
        $this->Poitrine = $Poitrine;

        return $this;
    }

    public function getBras(): ?int
    {
        return $this->Bras;
    }

    public function setBras(?int $Bras): self
    {
        $this->Bras = $Bras;

        return $this;
    }

    public function getTourdetaille(): ?int
    {
        return $this->Tourdetaille;
    }

    public function setTourdetaille(?int $Tourdetaille): self
    {
        $this->Tourdetaille = $Tourdetaille;

        return $this;
    }

    public function getCuisses(): ?int
    {
        return $this->Cuisses;
    }

    public function setCuisses(?int $Cuisses): self
    {
        $this->Cuisses = $Cuisses;

        return $this;
    }

    public function getMollets(): ?int
    {
        return $this->Mollets;
    }

    public function setMollets(?int $Mollets): self
    {
        $this->Mollets = $Mollets;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
