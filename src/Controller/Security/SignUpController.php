<?php

namespace App\Controller\Security;

use App\Events\Injectors\ParamsInjector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route(['en_za'=>'/security/sign-up', 'af_za'=>'/sekuriteit/registreer'], name: 'app_security_signup_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => ''
        ]);
    }
}