<?php

namespace App\Form;

use App\Entity\Mesure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MesureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => true,
                    'Femme' => false,
                ]
            ])
            ->add('age')
            ->add('taille')
            ->add('poids')
            ->add('niveauActivite', ChoiceType::class, [
                'choices' => [
                    'Sédentaire' => 'sedentaire',
                    'Actif' => 'actif',
                    'Sportif' => 'sportif'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mesure::class,
        ]);
    }
}
