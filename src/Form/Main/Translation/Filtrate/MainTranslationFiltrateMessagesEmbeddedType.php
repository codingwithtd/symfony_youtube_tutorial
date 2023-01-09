<?php

namespace App\Form\Main\Translation\Filtrate;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateMessages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Parser;

class MainTranslationFiltrateMessagesEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $yaml = new Parser();
        $localeData = $yaml->parse(file_get_contents('../config/filters/filters-locale.yaml'));

        $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
        $locale = $whatINeed[1];

        $builder
            ->add('translationLocale', ChoiceType::class, [
                'required' => false,
                'label' => 'label-translation-locale-choice',
                'help' => 'help-translation-locale-choice',
                'row_attr' => ['class'=>'form-floating'],
                'placeholder' => 'filter-placeholder-please-select',
                'choices' => $localeData,
                //'data' => $locale,
            ])
            ->add('translationDescription', TextareaType::class, [
                'required' => false,
                'label' => 'label-translation-description',
                'help' => 'help-translation-description',
                'row_attr' => ['class'=>'form-floating'],
                'attr' => ['style' => 'height: 125px']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => MainTranslationFiltrateMessages::class
        ]);
    }
}