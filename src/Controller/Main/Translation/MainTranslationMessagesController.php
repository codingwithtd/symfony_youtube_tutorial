<?php

namespace App\Controller\Main\Translation;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateMessages;
use App\Entity\Main\Translation\MainTranslationMessages;
use App\Events\Injectors\ParamsInjector;
use App\Form\Main\Translation\MainTranslationMessagesType;
use App\Repository\Main\Translation\MainTranslationMessagesRepository;
use App\Utilities\Slugger;
use Doctrine\ORM\Exception\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main/translation/messages')]
#[IsGranted('ROLE_ADMIN_USER')]
class MainTranslationMessagesController extends AbstractController
{
    private ParamsInjector $pageInjector;

    public function __construct(ParamsInjector $injector)
    {
        $this->pageInjector = $injector;
    }

    #[Route('/', name: 'app_main_translation_messages_index', methods: ['GET'])]
    public function index(MainTranslationMessagesRepository $mainTranslationMessagesRepository): Response
    {
        $page_content = '1';

        if($mainTranslationMessagesRepository->findAll())
            $page_content = $mainTranslationMessagesRepository->findBy(['mainFilterTranslationCategories' => '326']);

        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/index.html.twig',
            'page_content' => $page_content
        ]);
    }

    /**
     * @throws ORMException
     */
    #[Route('/new', name: 'app_main_translation_messages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MainTranslationMessagesRepository $mainTranslationMessagesRepository): Response
    {
        $mainTranslationMessage = new MainTranslationMessages();

        $filter = new MainTranslationFiltrateMessages();
        $filter->setTranslationLocale('en_za');
        $filter->setTranslationDescription('...');
        $mainTranslationMessage->addFilterTranslation($filter);

        $filter = new MainTranslationFiltrateMessages();
        $filter->setTranslationLocale('af_za');
        $filter->setTranslationDescription('...');
        $mainTranslationMessage->addFilterTranslation($filter);

        $form = $this->createForm(MainTranslationMessagesType::class, $mainTranslationMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationMessage->setIsApproved(true);
                $mainTranslationMessage->setApprovedAt(new \DateTime('now'));
                $mainTranslationMessage->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationMessage->setCreatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey'] === true) {
                $mainTranslationMessage->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }else{
                $mainTranslationMessage->setTranslationKey(Slugger::slugify('Filters Translations Message '.$form['filterTranslation'][0]['translationDescription']->getData()));
            }

            $mainTranslationMessagesRepository->save($mainTranslationMessage, true);

            $this->addFlash('success', 'alert-success-new-meaning');

            return $this->redirectToRoute('app_main_translation_messages_show', ['id'=>$mainTranslationMessage->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationMessage,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_main_translation_messages_show', methods: ['GET'])]
    public function show(MainTranslationMessages $mainTranslationMessage): Response
    {
        return $this->render('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/show.html.twig',
            'page_content' => $mainTranslationMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_main_translation_messages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainTranslationMessages $mainTranslationMessage, MainTranslationMessagesRepository $mainTranslationMessagesRepository): Response
    {
        $form = $this->createForm(MainTranslationMessagesType::class, $mainTranslationMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['formApprovals']['isApproved']->getData()){
                $mainTranslationMessage->setIsApproved(true);
                $mainTranslationMessage->setApprovedAt(new \DateTime('now'));
                $mainTranslationMessage->setApprovedBy('WebAdmin');//$this->getUser());
            }

            $mainTranslationMessage->setUpdatedBy($this->getUser());

            if ($form['formFilterCustom']['isCustomKey'] === true) {
                $mainTranslationMessage->setTranslationKey(Slugger::slugify($form['formFilterCustom']['customTranslationKey']->getData()));
            }

            $mainTranslationMessagesRepository->save($mainTranslationMessage, true);

            $this->addFlash('success', 'alert-success-edit-meaning');

            return $this->redirectToRoute('app_main_translation_messages_show', ['id'=>$mainTranslationMessage->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main/index.html.twig', [
            'page_params' => $this->pageInjector->params(),
            'page_content_url' => $this->pageInjector->urlPath().'/form.html.twig',
            'page_content' => $mainTranslationMessage,
            'page_form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_main_translation_messages_delete', methods: ['POST'])]
    public function delete(Request $request, MainTranslationMessages $mainTranslationMessage, MainTranslationMessagesRepository $mainTranslationMessagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainTranslationMessage->getId(), $request->request->get('_token'))) {
            $mainTranslationMessagesRepository->remove($mainTranslationMessage, true);
        }

        $this->addFlash('success', 'alert-success-remove-meaning');

        return $this->redirectToRoute('app_main_translation_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}
