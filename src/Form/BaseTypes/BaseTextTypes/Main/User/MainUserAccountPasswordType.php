<?php

namespace App\Form\BaseTypes\BaseTextTypes\Main\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MainUserAccountPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resetPassword', CheckboxType::class, [
                'required' => false,
                'mapped' => false,
                'label' => 'label-user-account-toggle-reset-password',
                'help' => 'help-user-account-toggle-reset-password',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'mapped' => false,
                'invalid_message' => 'alert-match-user-account-password',
                'options' => ['attr' => ['class' => 'password-field']],
                'first_options' => [
                    'label' => 'label-user-account-password',
                    'help' => 'help-user-account-password',
                    'attr' => ['value' => 'password'],
                    'row_attr' => ['class' => 'form-floating']
                ],
                'second_options' => [
                    'label' => 'label-user-account-confirm-password',
                    'help' => 'help-user-account-confirm-password',
                    'attr' => ['value' => 'confirm password'],
                    'row_attr' => ['class' => 'form-floating']
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'alert-blank-user-account-password'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'alert-valid-min-user-account-password',
                        'max' => 40,
                        'maxMessage' => 'alert-valid-max-user-account-password',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
           'inherit_data' => true,
        ]);
    }
}