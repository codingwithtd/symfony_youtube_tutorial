<?php

namespace App\Form\BaseTypes\BaseChoiceTypes\Main\Filter\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Repository\Main\Filter\Translation\MainFilterTranslationCategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainFilterTranslationCategoriesChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
        $locale = $whatINeed[1];

        $builder
            ->add('mainFilterTranslationCategories', EntityType::class, [
                    'label' => 'label-translation-category-choice',
                    'help' => 'help-translation-category-choice',
                    'placeholder' => 'filter-placeholder-please-select',
                    'help_attr' => ['class'=>'help-text'],
                    'row_attr' => ['class'=>'form-floating'],
                    'class' => MainFilterTranslationCategories::class,
                    'query_builder' => function(MainFilterTranslationCategoriesRepository $er) use ($locale) {
                        return $er->createQueryBuilder('u')
                            ->addSelect('r')
                            ->leftJoin('u.filterTranslation', 'r')
                            ->where('r.translationLocale = :translationLocale')
                            ->andWhere('u.isActive = :isActive')
                            ->andWhere('u.isApproved = :isApproved')
                            ->setParameter('isActive', true)
                            ->setParameter('isApproved', true)
                            ->setParameter('translationLocale', $locale)
                            ->orderBy('r.translationDescription', 'ASC')
                            ;
                    },
                    'choice_label' => function ($options){
                        foreach ($options->getFilterTranslation() as $item){
                            return $item;
                        }
                    }
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
        ]);
    }
}