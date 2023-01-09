<?php

namespace App\Form\BaseTypes\BaseFormTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormFilterTranslation extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translationValue', TextType::class, [
                'required' => false,
                'label' => 'label-translation-value',
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help' => 'help-translation-value',
                'help_attr' => ['class' => 'help-text'],
            ])
            ->add('translationKey', TextType::class, [
                'required' => false,
                'label' => 'label-translation-key',
                'attr' => [
                    'readonly' => 'readonly',
                    'class' => 'readonly',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help' => 'help-translation-key',
                'help_attr' => ['class' => 'help-text'],
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