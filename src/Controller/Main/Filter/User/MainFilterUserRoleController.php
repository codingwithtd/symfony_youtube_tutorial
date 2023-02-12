<?php

namespace App\Controller\Main\Filter\User;

use App\Entity\Main\Filter\User\MainFilterUserRole;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\Filter\User\MainFilterUserRoleType;
use App\Repository\Main\Filter\User\MainFilterUserRoleRepository;
use App\Utilities\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/filter/user/role')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainFilterUserRoleController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_filter_user_role_index', methods: ['GET'])]
    public function index(MainFilterUserRoleRepository $mainFilterUserRoleRepository): Response
    {
        $page_content = '1';

        if($mainFilterUserRoleRepository->findAll())
            $page_content = $mainFilterUserRoleRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_filter_user_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainFilterUserRoleRepository $mainFilterUserRoleRepository): Response
    {
        $mainFilterUserRole = new MainFilterUserRole();
        $form = $this->createForm(MainFilterUserRoleType::class, $mainFilterUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainFilterUserRole->setIsApproved(true);
                $mainFilterUserRole->setApprovedAt(new \DateTime('now'));
                $mainFilterUserRole->setApprovedBy($this->getUser());
            }

            $mainFilterUserRole->setCreatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainFilterUserRole->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }else{
                $mainFilterUserRole->setTranslationKey(Slugger::slugify('Filters User Security Role '.$form['Title']->getData()));
            }

            $mainFilterUserRoleRepository->save($mainFilterUserRole, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_filter_user_role_show', ['id'=>$mainFilterUserRole->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainFilterUserRole,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_filter_user_role_show', methods: ['GET'])]
    public function show(MainFilterUserRole $mainFilterUserRole): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainFilterUserRole,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_filter_user_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainFilterUserRole $mainFilterUserRole, MainFilterUserRoleRepository $mainFilterUserRoleRepository): Response
    {
        $form = $this->createForm(MainFilterUserRoleType::class, $mainFilterUserRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainFilterUserRole->setIsApproved(true);
                $mainFilterUserRole->setApprovedAt(new \DateTime('now'));
                $mainFilterUserRole->setApprovedBy($this->getUser());
            }

            $mainFilterUserRole->setUpdatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainFilterUserRole->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }

            $mainFilterUserRoleRepository->save($mainFilterUserRole, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_filter_user_role_show', ['id'=>$mainFilterUserRole->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainFilterUserRole,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_filter_user_role_delete', methods: ['POST'])]
    #[IsGranted('ROLE_SUPER_ADMIN')]
    public function delete(Request $request, MainFilterUserRole $mainFilterUserRole, MainFilterUserRoleRepository $mainFilterUserRoleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainFilterUserRole->getId(), $request->request->get('_token'))) {
            $mainFilterUserRoleRepository->remove($mainFilterUserRole, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_filter_user_role_index', [], Response::HTTP_SEE_OTHER);
    }
}
