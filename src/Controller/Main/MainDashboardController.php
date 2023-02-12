<?php

namespace App\Controller\Main;

use App\Events\Injectors\ParamsInjector;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainDashboardController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_dashboard_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'index.html.twig',
            'page_content' => '1'
        ]);
    }
}