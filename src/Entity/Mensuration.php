<?php

namespace App\Entity;

use App\Repository\MensurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MensurationRepository::class)
 */
class Mensuration
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
}
