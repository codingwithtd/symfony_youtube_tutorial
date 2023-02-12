<?php

namespace App\Controller\Main\User;

use App\Entity\Main\User\MainUserAccount;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\User\MainUserAccountType;
use App\Repository\Main\User\MainUserAccountRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/user/account')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainUserAccountController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_user_account_index', methods: ['GET'])]
    public function index(MainUserAccountRepository $mainUserAccountRepository): Response
    {
        $page_content = '1';

        if($mainUserAccountRepository->findAll())
            $page_content = $mainUserAccountRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_user_account_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainUserAccountRepository $mainUserAccountRepository): Response
    {
        $mainUserAccount = new MainUserAccount();
        $form = $this->createForm(MainUserAccountType::class, $mainUserAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mainUserAccountRepository->save($mainUserAccount, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_user_account_show', ['id'=>$mainUserAccount->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainUserAccount,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_user_account_show', methods: ['GET'])]
    public function show(MainUserAccount $mainUserAccount): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainUserAccount,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_user_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainUserAccount $mainUserAccount, MainUserAccountRepository $mainUserAccountRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(MainUserAccountType::class, $mainUserAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['password']['resetPassword']->getData()){
                $password = $form['password']['plainPassword']['first']->getData();
                $mainUserAccount->setPassword(
                  $passwordHasher->hashPassword(
                      $mainUserAccount,
                      $password
                  )
                );
            }

            $mainUserAccountRepository->save($mainUserAccount, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_user_account_show', ['id'=>$mainUserAccount->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainUserAccount,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_user_account_delete', methods: ['POST'])]
    public function delete(Request $request, MainUserAccount $mainUserAccount, MainUserAccountRepository $mainUserAccountRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainUserAccount->getId(), $request->request->get('_token'))) {
            $mainUserAccountRepository->remove($mainUserAccount, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_user_account_index', [], Response::HTTP_SEE_OTHER);
    }
}
