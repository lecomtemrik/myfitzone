<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nucleos\UserBundle\Model\User as BaseUser;

//https://stackoverflow.com/questions/17369699/fosuserbundle-made-username-nullable-true

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ORM\Table(name="Utilisateur")
 */
class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity="Article", mappedBy="utilisateur")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, inversedBy="utilisateur", cascade={"persist", "remove"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Mesure::class, mappedBy="utilisateur")
     */
    private $mesures;

    /**
     * @ORM\OneToMany(targetEntity=Mensuration::class, mappedBy="utilisateur")
     */
    private $mensurations;

    /**
     * @ORM\OneToMany(targetEntity=MensurationObjectif::class, mappedBy="utilisateur", orphanRemoval=true)
     */
    private $mensurationObjectifs;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->mesures = new ArrayCollection();
        $this->mensurations = new ArrayCollection();
        $this->mensurationObjectifs = new ArrayCollection();
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Mesure[]
     */
    public function getMesures(): Collection
    {
        return $this->mesures;
    }

    public function addMesure(Mesure $mesure): self
    {
        if (!$this->mesures->contains($mesure)) {
            $this->mesures[] = $mesure;
            $mesure->setUtilisateur($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): self
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getUtilisateur() === $this) {
                $mesure->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mensuration[]
     */
    public function getMensurations(): Collection
    {
        return $this->mensurations;
    }

    public function addMensuration(Mensuration $mensuration): self
    {
        if (!$this->mensurations->contains($mensuration)) {
            $this->mensurations[] = $mensuration;
            $mensuration->setUtilisateur($this);
        }

        return $this;
    }

    public function removeMensuration(Mensuration $mensuration): self
    {
        if ($this->mensurations->removeElement($mensuration)) {
            // set the owning side to null (unless already changed)
            if ($mensuration->getUtilisateur() === $this) {
                $mensuration->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MensurationObjectif[]
     */
    public function getMensurationObjectifs(): Collection
    {
        return $this->mensurationObjectifs;
    }

    public function addMensurationObjectif(MensurationObjectif $mensurationObjectif): self
    {
        if (!$this->mensurationObjectifs->contains($mensurationObjectif)) {
            $this->mensurationObjectifs[] = $mensurationObjectif;
            $mensurationObjectif->setUtilisateur($this);
        }

        return $this;
    }

    public function removeMensurationObjectif(MensurationObjectif $mensurationObjectif): self
    {
        if ($this->mensurationObjectifs->removeElement($mensurationObjectif)) {
            // set the owning side to null (unless already changed)
            if ($mensurationObjectif->getUtilisateur() === $this) {
                $mensurationObjectif->setUtilisateur(null);
            }
        }

        return $this;
    }
}
