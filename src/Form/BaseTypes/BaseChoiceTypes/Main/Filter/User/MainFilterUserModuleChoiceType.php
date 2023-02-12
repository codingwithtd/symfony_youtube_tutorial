<?php

namespace App\Form\BaseTypes\BaseChoiceTypes\Main\Filter\User;

use App\Entity\Main\Filter\User\MainFilterUserModule;
use App\Repository\Main\Filter\User\MainFilterUserModuleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainFilterUserModuleChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
        $locale = $whatINeed[1];

        $builder
            ->add('mainFilterUserModule', EntityType::class, [
                'label' => 'label-filter-user-module-choice',
                'help' => 'help-filter-user-module-choice',
                'placeholder' => 'filters-placeholder-please-select',
                'help_attr' => ['class'=>'help-text'],
                'row_attr' => ['class' => 'form-floating'],
                'class' => MainFilterUserModule::class,
                'query_builder' => function(MainFilterUserModuleRepository $er) use ($locale) {
                    return $er->createQueryBuilder('u')
                        ->addSelect('r')
                        ->leftJoin('u.filterTranslation', 'r')
                        ->where('r.translationLocale = :translationLocale')
                        ->andWhere('u.isActive = :isActive')
                        ->setParameter('isActive', true)
                        ->setParameter('translationLocale', $locale)
                        ;
                },
                'choice_label' => function ($options) {
                    foreach ($options->getFilterTranslation() as $document) {
                        return $document;
                    }
                }
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