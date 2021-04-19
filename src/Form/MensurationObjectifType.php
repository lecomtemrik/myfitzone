<?php

namespace App\Form;

use App\Entity\MensurationObjectif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensurationObjectifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Cou')
            ->add('Epaules')
            ->add('Poitrine')
            ->add('Bras')
            ->add('Tourdetaille')
            ->add('Cuisses')
            ->add('Mollets')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MensurationObjectif::class,
        ]);
    }
}
