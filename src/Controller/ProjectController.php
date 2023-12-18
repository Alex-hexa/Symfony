<?php

namespace App\Controller;

/*
use App\Entity\Tag;
use App\Repository\ProjectRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
*/

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /*  
    private $em;
    private $projectRepository;
    public function __construct(EntityManagerInterface $em, ProjectRepository $projectRepository, TagRepository $tagRepository)
    {
        $this->em = $em;
        $this->projectRepository = $projectRepository;
        $this->tagRepository = $tagRepository;
    }
    */
    
    #[Route("/read/project/{id}", name: "read_project")]
    public function read(Project $project): Response
    {
        if (!$project) {
            throw $this->createNotFoundException();
        }
        return $this->render("projet/readProject.html.twig", ["projet" => $project]);
    }

    
    #[Route("/createProject", name: "create_project")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($project);
            $em->flush();
            $this->addFlash("success", "Le projet '{$project->getTitle()}' a été créée !");
            return $this->redirectToRoute("home");
        }
        return $this->render("projet/form.html.twig", [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }

    #[Route("/delete/project/{id}", name: "delete_project")]
    public function delete(Project $project, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->addFlash("danger", "Le projet '{$project->getTitle()}' a été supprimée !");
        $em = $doctrine->getManager();
        $em->remove($project);
        $em->flush();
        return $this->redirectToRoute("home");
    }

    #[Route("/update/project/{id}", name: "update_project")]
    public function update(Project $project, Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();
            $this->addFlash("warning", "Le projet '{$project->getTitle()}' a été modifiée !");
            return $this->redirectToRoute("home");
        }

        return $this->render("projet/form.html.twig", [
            "form" => $form->createView(),
            "project" => $project,
            "type" => "update",
        ]);
    }
}
