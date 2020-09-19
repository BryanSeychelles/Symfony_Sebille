<?php

namespace App\Form;

use App\Entity\Pictures;
use App\Entity\Gites;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Description')
            ->add('chambres')
            ->add('douches')
            ->add('surface')
            ->add('lits')
            ->add('dressing')
            ->add('tarifs')
            ->add('imageFileMiniature', FileType::class, [
                'required' => false
            ])
            ->add('imageFiles', FileType::class, [
                'multiple' => true,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gites::class,
        ]);
    }
}
