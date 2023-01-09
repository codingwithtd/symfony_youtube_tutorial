<?php

namespace App\Form\BaseTypes\BaseFormTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormActiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'label-toggle-active',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('createdBy',HiddenType::class, [
                'label' => false,
                'required' => false,
                //'empty_data' => '',
                'attr' => ['value' => 'Unknown']
                //'attr' => ['value' => $this->token->getToken()->getUser()]
            ])
            ->add('updatedBy',HiddenType::class, [
                'label' => false,
                'required' => false,
                //'empty_data' => '',
                'attr' => ['value' => 'Unknown']
                //'attr' => ['value' => $this->token->getToken()->getUser()]
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