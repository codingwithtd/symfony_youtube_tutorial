<?php

namespace App\Form\BaseTypes\BaseFormTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormApprovalsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isApproved', CheckboxType::class, [
                'required' => false,
                'label' => 'label-toggle-approved',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
                'help' => 'help-toggle-approved',
            ])
            ->add('approvedAt', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => 'label-approved-at',
                'attr' => [
                    'readonly' => 'readonly',
                    'class' => 'readonly',
                ],
                'help' => 'help-approved-at',
                'help_attr' => ['class' => 'help-text'],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('approvedBy', TextType::class, [
                'required' => false,
                'label' => 'label-approved-by',
                'attr' => [
                    'readonly' => 'readonly',
                    'class' => 'readonly',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help' => 'help-approved-by',
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