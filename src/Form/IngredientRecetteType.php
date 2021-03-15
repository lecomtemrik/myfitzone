<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\IngredientRecette;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('poids')
            ->add('ingredients', EntityType::class,[
                'class' => Ingredient::class,
                'choice_label'=>'nom'
            ])
            ->add('recettes', EntityType::class,[
                'class' => Recette::class,
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientRecette::class,
        ]);
    }
}
