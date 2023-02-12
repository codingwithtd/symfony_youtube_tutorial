<?php

namespace App\Form\Main\Translation;

use App\Entity\Main\Translation\MainTranslationValidators;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainTranslationValidatorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive')
            ->add('translationKey')
            ->add('translationValue')
            ->add('isApproved')
            ->add('approvedAt')
            ->add('approvedBy')
            ->add('createdAt')
            ->add('createdBy')
            ->add('updatedAt')
            ->add('updatedBy')
            ->add('mainFilterTranslationCategories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MainTranslationValidators::class,
        ]);
    }
}
