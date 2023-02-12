<?php

namespace App\Form\BaseTypes\BaseChoiceTypes\Main\User;

use App\Entity\Main\Filter\User\MainFilterUserModule;
use App\Entity\Main\User\MainUserAccount;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainUserAccountChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mainUserAccount', EntityType::class, [
                'label' => 'label-user-account-choice',
                'help' => 'help-user-account-choice',
                'placeholder' => 'filters-placeholder-please-select',
                'help_attr' => ['class'=>'help-text'],
                'row_attr' => ['class' => 'form-floating'],
                'class' => MainUserAccount::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
        ]);
    }
}