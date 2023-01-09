<?php

namespace App\Events\SQLFilters\Main\Filter\Translation\Filtrate;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class MainFilterTranslationFiltrateCategoriesSQLFilter extends SQLFilter
{

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        // check if the entity implements the interface

        if ($targetEntity->getReflectionClass()->name != 'App\Entity\Main\Filter\Translation\Filtrate\MainFilterTranslationFiltrateCategories'){
            return '';
        }

        return $targetTableAlias.'.translation_locale = ' . $this->getParameter('translation_locale');
    }
}