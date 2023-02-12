<?php

namespace App\Form\Main\User;

use App\Entity\Main\User\MainUserRole;
use App\Form\BaseTypes\BaseChoiceTypes\Main\Filter\User\MainFilterUserModuleChoiceType;
use App\Form\BaseTypes\BaseChoiceTypes\Main\Filter\User\MainFilterUserRoleChoiceType;
use App\Form\BaseTypes\BaseChoiceTypes\Main\User\MainUserAccountChoiceType;
use App\Form\BaseTypes\BaseFormTypes\FormActiveType;
use App\Form\BaseTypes\BaseFormTypes\FormApprovalsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainUserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('formActivity', FormActiveType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserRole::class,
            ])
            ->add('formApprovals', FormApprovalsType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserRole::class,
            ])
            ->add('roleImplementDate', DateType::class)
            ->add('roleReviewDate', DateType::class)
            ->add('roleExpiryDate', DateType::class)
            ->add('roleDescription', TextareaType::class, [
                'required' => false,
                'label' => 'label-user-role-description',
                'help' => 'help-user-role-description',
                'row_attr' => ['class'=>'form-floating'],
                'attr' => ['style' => 'height: 125px']
            ])
            ->add('mainUserAccount', MainUserAccountChoiceType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserRole::class,
            ])
            ->add('mainFilterUserRole', MainFilterUserRoleChoiceType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserRole::class,
            ])
            ->add('mainFilterUserModule', MainFilterUserModuleChoiceType::class,[
                'required' =>false,
                'label' => false,
                'data_class' => MainUserRole::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MainUserRole::class,
        ]);
    }
}
