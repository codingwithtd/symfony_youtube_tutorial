<?php

namespace App\Controller\Main\Translation\Export;

use App\Entity\Main\Translation\Filtrate\MainTranslationFiltrateMessages;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

#[Route('/main/translation/export/messages')]
class MainTranslationMessagesExportController extends AbstractController
{
    #[Route('/', name: 'app_main_translation_export_messages_index', methods: ['GET'])]
    public function export(Request $request, ManagerRegistry $doctrine): Response
    {
        $locale = $request->getLocale();

        //backup our old translation file
        $old_name = '../translations/messages.'.$locale.'.yaml';

        $backup_name = '../translations/'.time().'-messages.'.$locale.'.yaml';

        rename($old_name,$backup_name);

        $repository = $doctrine->getRepository(MainTranslationFiltrateMessages::class);
        $tableLines = $repository->findBy(
            ['isActive' => true],
            ['mainTranslationMessages' => 'ASC']
        );

        foreach ($tableLines as $tableLine){

            if ($tableLine->getTranslationLocale() == $locale){

                $output = [$tableLine->getMainTranslationMessages()->getTranslationKey() => $tableLine->getTranslationDescription()];
                $yaml = Yaml::dump($output, 1, 1, Yaml::PARSE_OBJECT);
                file_put_contents('../translations/messages.'.$locale.'.yaml', $yaml, FILE_APPEND);
            }
        }

        $this->addFlash('success', 'alert-success-file-export-meaning');

        return $this->redirectToRoute('app_main_translation_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}