<?php

namespace App\Form;

use App\Entity\Mensuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $var = 37;
        $builder
            ->add('Cou', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
            ->add('Epaules', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
            ->add('Poitrine', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
            ->add('Bras', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                    'placeholder' => $var
                ]])
            ->add('Tourdetaille', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
            ->add('Cuisses', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
            ->add('Mollets', null,
                [
                    'required'   => false,
                    'empty_data' => '37',
                    'attr' => [
                        'placeholder' => $var
                    ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mensuration::class,
        ]);
    }
}
