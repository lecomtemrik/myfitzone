<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iconCategorie;

    /**
     * @ORM\OneToMany(targetEntity="Souscategorie", mappedBy="categorie")
     */
    private $sousCategorie;

    public function __construct()
    {
        $this->sousCategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIconCategorie()
    {
        return $this->iconCategorie;
    }

    /**
     * @param mixed $iconCategorie
     */
    public function setIconCategorie($iconCategorie): void
    {
        $this->iconCategorie = $iconCategorie;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sousCategorie;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategorie->contains($sousCategorie)) {
            $this->sousCategorie[] = $sousCategorie;
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->article->contains($sousCategorie)) {
            $this->article->removeElement($sousCategorie);
        }

        return $this;
    }

//    /**
//     * @param ArrayCollection $article
//     */
//    public function setArticle(ArrayCollection $article): void
//    {
//        $this->article = $article;
//    }

}
