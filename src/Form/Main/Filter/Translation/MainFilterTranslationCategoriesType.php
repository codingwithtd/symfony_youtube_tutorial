<?php

namespace App\Form\Main\Filter\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Entity\Main\Translation\MainTranslationMessages;
use App\Form\BaseTypes\BaseFormTypes\FormActiveType;
use App\Form\BaseTypes\BaseFormTypes\FormApprovalsType;
use App\Form\BaseTypes\BaseFormTypes\FormFilterTranslation;
use App\Form\BaseTypes\BaseFormTypes\FormTranslationCustomType;
use App\Form\Main\Filter\Translation\Filtrate\MainFilterTranslationCategoriesEmbeddedType;
use App\Form\Main\Filter\User\Filtrate\MainFilterUserRoleEmbeddedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('filterTranslation', CollectionType::class,[
                'required' => false,
                'label' => false,
                'entry_type' => MainFilterTranslationCategoriesEmbeddedType::class,
                'entry_options' => [
                    'label' => false,
                    //'row_attr' => ['class'=>'form-floating'],
                ]
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
