<?php

namespace App\Events\Listeners\Main\Filter\User\Filtrate;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class MainFilterUserRoleListener
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
            ->enable('main_filter_user_filtrate_role');
        $filter->setParameter('translation_locale', $locale);
    }
}