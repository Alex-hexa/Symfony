<?php
// src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Candidater;
use App\Form\CandidaterType;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidaterController extends AbstractController
{
    #[Route('/candidater', name: 'candidater')]
    public function new(Request $request, FileUploader $fileUploader, ManagerRegistry $doctrine): Response
    {
        $candidater = new Candidater();
        $form = $this->createForm(CandidaterType::class, $candidater);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                try {
                    $brochureFileName = $fileUploader->upload($brochureFile);
                    $candidater->setBrochureFilename($brochureFileName);
                } catch (FileException $e) {
                    $this->addFlash("danger", "Le fichier n'a pas été pris en compte !");
                }
                // Move the file to the directory where brochures are stored
            }

            // ... persist the $product variable or any other work
            $em = $doctrine->getManager();
            $em->persist($candidater);
            $em->flush();
            $this->addFlash("success", "Le candidature '{$candidater->getObjet()}' a été envoyée !");
            return $this->redirectToRoute('home');
        }

        return $this->render('candidater.html.twig', [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }
}
