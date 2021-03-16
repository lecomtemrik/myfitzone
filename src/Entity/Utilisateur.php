<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
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

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
}
