<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('slug')
            ->add('description')
            ->add('tagsText', TextType::class, ['required' => false, 'label' => 'Tags'])
            ->add('contenu', CKEditorType::class)
            ->add('dateCreation')
            ->add('dateModification')
            ->add('utilisateur')
            ->add('categorie', EntityType::class,[
                'class' => Categorie::class,
                'choice_label'=>'libelle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
