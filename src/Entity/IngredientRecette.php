<?php

namespace App\Entity;

use App\Repository\IngredientRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRecetteRepository::class)
 */
class IngredientRecette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $poids;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="ingredientRecettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity=Recette::class, inversedBy="ingredientRecettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recettes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getIngredients(): ?Ingredient
    {
        return $this->ingredients;
    }

    public function setIngredients(?Ingredient $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getRecettes(): ?Recette
    {
        return $this->recettes;
    }

    public function setRecettes(?Recette $recettes): self
    {
        $this->recettes = $recettes;

        return $this;
    }
}
