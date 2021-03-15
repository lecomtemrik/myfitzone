<?php

namespace App\Form;

use App\Entity\Recette;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('slug')
            ->add('description')
            ->add('dateCreation')
            ->add('dateModification')
            ->add('contenu', CKEditorType::class)
            ->add('tempsPreparation')
            ->add('tempsCuisson')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
