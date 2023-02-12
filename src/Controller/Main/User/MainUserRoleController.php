<?php

namespace App\Controller\Main\User;

use App\Entity\Main\User\MainUserRole;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\User\MainUserRoleType;
use App\Repository\Main\User\MainUserRoleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/user/role')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainUserRoleController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_user_role_index', methods: ['GET'])]
    public function index(MainUserRoleRepository $mainUserRoleRepository): Response
    {
        $page_content = '1';

        if($mainUserRoleRepository->findAll())
            $page_content = $mainUserRoleRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_user_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainUserRoleRepository $mainUserRoleRepository): Response
    {
        $mainUserRole = new MainUserRole();
        $form = $this->createForm(MainUserRoleType::class, $mainUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mainUserRoleRepository->save($mainUserRole, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_user_role_show', ['id'=>$mainUserRole->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainUserRole,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_user_role_show', methods: ['GET'])]
    public function show(MainUserRole $mainUserRole): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainUserRole,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_user_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainUserRole $mainUserRole, MainUserRoleRepository $mainUserRoleRepository): Response
    {
        $form = $this->createForm(MainUserRoleType::class, $mainUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mainUserRoleRepository->save($mainUserRole, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_user_role_show', ['id'=>$mainUserRole->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainUserRole,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_main_user_role_delete', methods: ['POST'])]
    #[IsGranted('ROLE_SUPER_ADMIN')]
    public function delete(Request $request, MainUserRole $mainUserRole, MainUserRoleRepository $mainUserRoleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainUserRole->getId(), $request->request->get('_token'))) {
            $mainUserRoleRepository->remove($mainUserRole, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_user_role_index', [], Response::HTTP_SEE_OTHER);
    }
}
