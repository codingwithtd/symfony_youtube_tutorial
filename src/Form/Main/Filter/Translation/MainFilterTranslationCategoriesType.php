<?php

namespace App\Form\Main\Filter\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Entity\Main\Translation\MainTranslationMessages;
use App\Form\BaseTypes\BaseFormTypes\FormActiveType;
use App\Form\BaseTypes\BaseFormTypes\FormApprovalsType;
use App\Form\BaseTypes\BaseFormTypes\FormFilterTranslation;
use App\Form\BaseTypes\BaseFormTypes\FormTranslationCustomType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainFilterTranslationCategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('formActivity', FormActiveType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainFilterTranslationCategories::class,
            ])
            ->add('formApprovals', FormApprovalsType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainFilterTranslationCategories::class,
            ])
            ->add('formFilterCustom', FormTranslationCustomType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainFilterTranslationCategories::class,
            ])
            ->add('formFilterTranslation', FormFilterTranslation::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainFilterTranslationCategories::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MainFilterTranslationCategories::class,
        ]);
    }
}
