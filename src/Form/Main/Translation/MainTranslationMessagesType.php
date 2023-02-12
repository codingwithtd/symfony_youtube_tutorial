<?php

namespace App\Form\Main\Translation;

use App\Entity\Main\Translation\MainTranslationMessages;
use App\Form\BaseTypes\BaseChoiceTypes\Main\Filter\Translation\MainFilterTranslationCategoriesChoiceType;
use App\Form\BaseTypes\BaseFormTypes\FormActiveType;
use App\Form\BaseTypes\BaseFormTypes\FormApprovalsType;
use App\Form\BaseTypes\BaseFormTypes\FormFilterTranslation;
use App\Form\BaseTypes\BaseFormTypes\FormTranslationCustomType;
use App\Form\Main\Translation\Filtrate\MainTranslationFiltrateMessagesEmbeddedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainTranslationMessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('formActivity', FormActiveType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainTranslationMessages::class,
            ])
            ->add('formApprovals', FormApprovalsType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainTranslationMessages::class,
            ])
            ->add('formFilterCustom', FormTranslationCustomType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainTranslationMessages::class,
            ])
            ->add('formFilterTranslation', FormFilterTranslation::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainTranslationMessages::class,
            ])
            ->add('mainFilterTranslationCategories', MainFilterTranslationCategoriesChoiceType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainTranslationMessages::class,
            ])
            ->add('filterTranslation', CollectionType::class,[
                'required' => false,
                'label' => false,
                'entry_type' => MainTranslationFiltrateMessagesEmbeddedType::class,
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
            'data_class' => MainTranslationMessages::class,
        ]);
    }
}
