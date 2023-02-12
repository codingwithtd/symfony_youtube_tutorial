<?php

namespace App\Form\Main\User;

use App\Entity\Main\User\MainUserAccount;
use App\Form\BaseTypes\BaseFormTypes\FormActiveType;
use App\Form\BaseTypes\BaseFormTypes\FormApprovalsType;
use App\Form\BaseTypes\BaseTextTypes\Main\User\MainUserAccountPasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Parser;

class MainUserAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $yaml = new Parser();
        $roleData = $yaml->parse(file_get_contents('../config/filters/filters-role.yaml'));

        $builder
            ->add('formActivity', FormActiveType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserAccount::class,
            ])
            ->add('formApprovals', FormApprovalsType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserAccount::class,
            ])
            ->add('accountID', TextType::class, [
                'required' => false,
                'label'=> 'label-user-account-id',
                'help' => 'help-user-account-id',
                'row_attr' => ['class' => 'form-floating']
            ])
            ->add('accountName', TextType::class, [
                'required' => false,
                'label'=> 'label-user-account-name',
                'help' => 'help-user-account-name',
                'row_attr' => ['class' => 'form-floating']
            ])
            ->add('isEmailAddress', CheckboxType::class, [
                'required' => false,
                'label'=> 'label-user-account-toggle-email',
                'help' => 'help-user-account-toggle-email',
                'label_attr' => ['class' => 'checkbox-inline checkbox-switch']
            ])
            ->add('emailAddress', EmailType::class, [
                'required' => false,
                'label'=> 'label-user-account-email-address',
                'help' => 'help-user-account-email-address',
                'row_attr' => ['class' => 'form-floating']
            ])
            ->add('isMobileNumber', CheckboxType::class, [
                'required' => false,
                'label'=> 'label-user-account-toggle-mobile',
                'help' => 'help-user-account-toggle-mobile',
                'label_attr' => ['class' => 'checkbox-inline checkbox-switch']
            ])
            ->add('mobileNumber', TelType::class, [
                'required' => false,
                'label'=> 'label-user-account-mobile-number',
                'help' => 'help-user-account-mobile-number',
                'row_attr' => ['class' => 'form-floating']
            ])
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'label' => 'label-user-role-description',
                'help' => 'help-user-role-description',
                'row_attr' => ['class'=>'form-floating'],
                'placeholder' => 'filter-placeholder-please-select',
                'choices' => $roleData,
                'multiple' => true,
                'expanded' => true,
                'label_attr' => ['class' => 'checkbox-inline checkbox-switch']
            ])
            ->add('password', MainUserAccountPasswordType::class, [
                'required' => false,
                'label' => false,
                'data_class' => MainUserAccount::class,
            ])
            //->add('userAvatar')
            //->add('userProfile')
            //->add('userSetting')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MainUserAccount::class,
        ]);
    }
}
