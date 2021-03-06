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
     * @ORM\OneToOne(targetEntity=Profil::class, mappedBy="utilisateur", cascade="all")
     */
    protected $profil;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, mappedBy="utilisateur", cascade="all")
     */
    protected $adresse;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
