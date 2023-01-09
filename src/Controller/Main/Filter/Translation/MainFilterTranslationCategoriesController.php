<?php

namespace App\Controller\Main\Filter\Translation;

use App\Entity\Main\Filter\Translation\MainFilterTranslationCategories;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\Filter\Translation\MainFilterTranslationCategoriesType;
use App\Repository\Main\Filter\Translation\MainFilterTranslationCategoriesRepository;
use App\Utilities\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/filter/translation/categories')]
class MainFilterTranslationCategoriesController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_filter_translation_categories_index', methods: ['GET'])]
    public function index(MainFilterTranslationCategoriesRepository $mainFilterTranslationCategoriesRepository): Response
    {
        $page_content = '1';

        if($mainFilterTranslationCategoriesRepository->findAll())
            $page_content = $mainFilterTranslationCategoriesRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_filter_translation_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainFilterTranslationCategoriesRepository $mainFilterTranslationCategoriesRepository): Response
    {
        $mainFilterTranslationCategory = new MainFilterTranslationCategories();
        $form = $this->createForm(MainFilterTranslationCategoriesType::class, $mainFilterTranslationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainFilterTranslationCategory->setIsApproved(true);
                $mainFilterTranslationCategory->setApprovedAt(new \DateTime('now'));
                $mainFilterTranslationCategory->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainFilterTranslationCategory->setCreatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainFilterTranslationCategory->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }else{
                $mainFilterTranslationCategory->setTranslationKey(Slugger::slugify('Filters Translations Category '.$form['Title']->getData()));
            }

            $mainFilterTranslationCategoriesRepository->save($mainFilterTranslationCategory, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_filter_translation_categories_show', ['id'=>$mainFilterTranslationCategory->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainFilterTranslationCategory,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_filter_translation_categories_show', methods: ['GET'])]
    public function show(MainFilterTranslationCategories $mainFilterTranslationCategory): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainFilterTranslationCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_filter_translation_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainFilterTranslationCategories $mainFilterTranslationCategory, MainFilterTranslationCategoriesRepository $mainFilterTranslationCategoriesRepository): Response
    {
        $form = $this->createForm(MainFilterTranslationCategoriesType::class, $mainFilterTranslationCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainFilterTranslationCategory->setIsApproved(true);
                $mainFilterTranslationCategory->setApprovedAt(new \DateTime('now'));
                $mainFilterTranslationCategory->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainFilterTranslationCategory->setUpdatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainFilterTranslationCategory->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }

            $mainFilterTranslationCategoriesRepository->save($mainFilterTranslationCategory, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_filter_translation_categories_show', ['id'=>$mainFilterTranslationCategory->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainFilterTranslationCategory,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_filter_translation_categories_delete', methods: ['POST'])]
    public function delete(Request $request, MainFilterTranslationCategories $mainFilterTranslationCategory, MainFilterTranslationCategoriesRepository $mainFilterTranslationCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainFilterTranslationCategory->getId(), $request->request->get('_token'))) {
            $mainFilterTranslationCategoriesRepository->remove($mainFilterTranslationCategory, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_filter_translation_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
