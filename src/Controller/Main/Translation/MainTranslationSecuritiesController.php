<?php

namespace App\Controller\Main\Translation;

use App\Entity\Main\Translation\MainTranslationSecurities;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\Translation\MainTranslationSecuritiesType;
use App\Repository\Main\Translation\MainTranslationSecuritiesRepository;
use App\Utilities\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/translation/securities')]
class MainTranslationSecuritiesController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_translation_securities_index', methods: ['GET'])]
    public function index(MainTranslationSecuritiesRepository $mainTranslationSecuritiesRepository): Response
    {
        $page_content = '1';

        if($mainTranslationSecuritiesRepository->findAll())
            $page_content = $mainTranslationSecuritiesRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_translation_securities_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainTranslationSecuritiesRepository $mainTranslationSecuritiesRepository): Response
    {
        $mainTranslationSecurity = new MainTranslationSecurities();
        $form = $this->createForm(MainTranslationSecuritiesType::class, $mainTranslationSecurity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationSecurity->setIsApproved(true);
                $mainTranslationSecurity->setApprovedAt(new \DateTime('now'));
                $mainTranslationSecurity->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationSecurity->setCreatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainTranslationSecurity->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }else{
                $mainTranslationSecurity->setTranslationKey(Slugger::slugify('Filters Translations Security '.$form['Title']->getData()));
            }

            $mainTranslationSecuritiesRepository->save($mainTranslationSecurity, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_translation_securities_show', ['id'=>$mainTranslationSecurity->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationSecurity,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_translation_securities_show', methods: ['GET'])]
    public function show(MainTranslationSecurities $mainTranslationSecurity): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainTranslationSecurity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_translation_securities_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainTranslationSecurities $mainTranslationSecurity, MainTranslationSecuritiesRepository $mainTranslationSecuritiesRepository): Response
    {
        $form = $this->createForm(MainTranslationSecuritiesType::class, $mainTranslationSecurity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationSecurity->setIsApproved(true);
                $mainTranslationSecurity->setApprovedAt(new \DateTime('now'));
                $mainTranslationSecurity->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationSecurity->setUpdatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainTranslationSecurity->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }

            $mainTranslationSecuritiesRepository->save($mainTranslationSecurity, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_translation_securities_show', ['id'=>$mainTranslationSecurity->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationSecurity,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_translation_securities_delete', methods: ['POST'])]
    public function delete(Request $request, MainTranslationSecurities $mainTranslationSecurity, MainTranslationSecuritiesRepository $mainTranslationSecuritiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainTranslationSecurity->getId(), $request->request->get('_token'))) {
            $mainTranslationSecuritiesRepository->remove($mainTranslationSecurity, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_translation_securities_index', [], Response::HTTP_SEE_OTHER);
    }
}
