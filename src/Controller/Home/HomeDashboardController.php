<?php

namespace App\Controller\Home;

use App\Events\Injectors\ParamsInjector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeDashboardController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route(['en_za'=>'/home', 'af_za'=>'/tuis'], name: 'app_home_dashboard_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'index.html.twig',
            'page_content' => '1'
        ]);
    }
}

