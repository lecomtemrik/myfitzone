<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Profil;
use App\Entity\Recette;
use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        ######################### RECETTE #########################
        $recette = new Recette();
        $photoCurry = new File('public\images\recettes\poulet-curry.jpg');
        $today = new \DateTime("now");

        $recette->setNom('Poulet curry');
        $recette->setImageFile($photoCurry);
        $recette->setImageName('pouletcurry');
        $recette->setSlug('poulet');
        $recette->setDescription('recette de poulet au curry');
        $recette->setDateCreation($today);
        $recette->setContenu('poulet au curry');
        $recette-> setTempsCuisson(10);
        $recette->setTempsPreparation(10);
        $manager->persist($recette);

        ######################### ADMIN Utilisateur #########################
        $adminUtilisateur = new User();

        $adminUtilisateur->setUsername('admin');
        $adminUtilisateur->setUsernameCanonical('admin');
        $adminUtilisateur->setEmail('admin@gmail.com');
        $adminUtilisateur->setEmailCanonical('admin@gmail.com');
        $adminUtilisateur->setEnabled(1);
        $adminUtilisateur->setPassword();
        $adminUtilisateur->setRoles();

        ######################### PROFIL #########################
        $profil = new Profil();

        $profil->setUtilisateur($adminUtilisateur);
        $profil->setNom('admin');
        $profil->setPrenom('admin');
        $profil->setPseudo('admin');
        $profil->setDateNaissance();
        $profil->setTelephone(0102030405);
        $profil->setDateCreation();

        ######################### ADRESSE #########################
        $adresse = new Adresse();

        $adresse->setUtilisateur($adminUtilisateur);
        $adresse->setPays('FRANCE');
        $adresse->setVille('LYON');
        $adresse->setAdressePostale('23 rue des admins');
        $adresse->setCodePostal(2021) ;

        $manager->flush();
    }
}
