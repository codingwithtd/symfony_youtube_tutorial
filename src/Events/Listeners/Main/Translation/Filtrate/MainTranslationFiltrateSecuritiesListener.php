<?php

namespace App\Events\Listeners\Main\Translation\Filtrate;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class MainTranslationFiltrateSecuritiesListener
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onKernelRequest(RequestEvent $em)
    {
        $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
        $locale = $whatINeed[1];

        $filter = $this->em
            ->getFilters()
            ->enable('main_translation_filtrate_securities');
        $filter->setParameter('translation_locale', $locale);
    }
}