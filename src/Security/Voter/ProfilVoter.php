<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'VIEW', 'DELETE'])
            && $subject instanceof \App\Entity\Profil;
    }

    protected function voteOnAttribute($attribute, $profil, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (null == $profil->getUtilisateur()){
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        //@todo: rajouter de la logique pour l'admin
        switch ($attribute) {
            case 'EDIT':
               return $profil->getUtilisateur()->getId() == $user->getId();
                break;
            case 'VIEW':
                return $profil->getUtilisateur()->getId() == $user->getId();
                break;
            case 'DELETE':
                return $profil->getUtilisateur()->getId() == $user->getId();
                break;
        }

        return false;
    }
}
