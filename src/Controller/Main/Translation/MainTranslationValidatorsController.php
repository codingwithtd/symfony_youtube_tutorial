<?php

namespace App\Controller\Main\Translation;

use App\Entity\Main\Translation\MainTranslationValidators;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\Translation\MainTranslationValidatorsType;
use App\Repository\Main\Translation\MainTranslationValidatorsRepository;
use App\Utilities\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/translation/validators')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainTranslationValidatorsController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }
    
    #[Route('/', name: 'app_main_translation_validators_index', methods: ['GET'])]
    public function index(MainTranslationValidatorsRepository $mainTranslationValidatorsRepository): Response
    {
        $page_content = '1';

        if($mainTranslationValidatorsRepository->findAll())
            $page_content = $mainTranslationValidatorsRepository->findAll();

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    #[Route('/new', name: 'app_main_translation_validators_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainTranslationValidatorsRepository $mainTranslationValidatorsRepository): Response
    {
        $mainTranslationValidator = new MainTranslationValidators();
        $form = $this->createForm(MainTranslationValidatorsType::class, $mainTranslationValidator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationValidator->setIsApproved(true);
                $mainTranslationValidator->setApprovedAt(new \DateTime('now'));
                $mainTranslationValidator->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationValidator->setCreatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainTranslationValidator->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }else{
                $mainTranslationValidator->setTranslationKey(Slugger::slugify('Filters Translations Validator '.$form['Title']->getData()));
            }

            $mainTranslationValidatorsRepository->save($mainTranslationValidator, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_translation_validators_show', ['id'=>$mainTranslationValidator->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationValidator,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_translation_validators_show', methods: ['GET'])]
    public function show(MainTranslationValidators $mainTranslationValidator): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainTranslationValidator,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_translation_validators_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainTranslationValidators $mainTranslationValidator, MainTranslationValidatorsRepository $mainTranslationValidatorsRepository): Response
    {
        $form = $this->createForm(MainTranslationValidatorsType::class, $mainTranslationValidator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationValidator->setIsApproved(true);
                $mainTranslationValidator->setApprovedAt(new \DateTime('now'));
                $mainTranslationValidator->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationValidator->setUpdatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey']) {
                $mainTranslationValidator->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }

            $mainTranslationValidatorsRepository->save($mainTranslationValidator, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_translation_validators_show', ['id'=>$mainTranslationValidator->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationValidator,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_translation_validators_delete', methods: ['POST'])]
    public function delete(Request $request, MainTranslationValidators $mainTranslationValidator, MainTranslationValidatorsRepository $mainTranslationValidatorsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainTranslationValidator->getId(), $request->request->get('_token'))) {
            $mainTranslationValidatorsRepository->remove($mainTranslationValidator, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_translation_validators_index', [], Response::HTTP_SEE_OTHER);
    }
}
