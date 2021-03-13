<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousCategorieRepository::class)
 */
class SousCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle_souscategorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon_souscategorie;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="sousCategorie")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="sousCategorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    public function __construct()
    {
        $this->article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleSouscategorie(): ?string
    {
        return $this->libelle_souscategorie;
    }

    public function setLibelleSouscategorie(string $libelle_souscategorie): self
    {
        $this->libelle_souscategorie = $libelle_souscategorie;

        return $this;
    }

    public function getIconSouscategorie(): ?string
    {
        return $this->icon_souscategorie;
    }

    public function setIconSouscategorie(?string $icon_souscategorie): self
    {
        $this->icon_souscategorie = $icon_souscategorie;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->article->contains($article)) {
            $this->article->removeElement($article);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $Categorie
     */
    public function setCategorie($Categorie): void
    {
        $this->categorie = $Categorie;
    }
}
