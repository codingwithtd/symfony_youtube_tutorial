<?php

namespace App\Form\BaseTypes\BaseFormTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormTranslationCustomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isCustomKey', CheckboxType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'label-translation-toggle-custom-key',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch'
                ],
                'help' => 'help-translation-toggle-custom-key'
            ])
            ->add('customTranslationKey', TextType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'label-translation-custom-key',
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'help' => 'help-translation-custom-key',
                'help_attr' => [
                    'class' => 'help-text'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'inherit_data' => true,
        ]);
    }
}