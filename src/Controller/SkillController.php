<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Tag;
use App\Form\SkillType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    #[Route("/{type}/{param}/{order}", name: "home")]
    public function readAll(Request $request, ManagerRegistry $doctrine, string $type = "skill", string $param = "title", string $order = "ASC"): Response
    {
        $skillRepository = $doctrine->getRepository(Skill::class);
        $skills = $skillRepository->findAll();
        $repo = $doctrine->getRepository(Tag::class);
        $tags = $repo->findAll();
        $projectRepository = $doctrine->getRepository(Project::class);
        $projects = $projectRepository->findAll();

        if ($param && $order) {
            if ($type === "skill") {
                $skills = $skillRepository->findBy([], [$param => $order]);
            } else {
                $projects = $projectRepository->findBy([], [$param => $order]);
            }
        }
        return $this->render("index.html.twig", ["talents" =>  $skills, "tags" =>  $tags, "projets" =>  $projects]);
    }

    #[Route("/read/skill/{id}", name: "read_skill")]
    public function read(Skill $skill): Response
    {
        if (!$skill) {
            throw $this->createNotFoundException();
        }
        return $this->render("talent/readTalent.html.twig", ["talent" => $skill]);
    }


    #[Route("/createTalent", name: "create_skill")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($skill);
            $em = $doctrine->getManager();
            $em->persist($skill);
            $em->flush();
            $this->addFlash("success", "La barre de talent '{$skill->getTitle()}' a été créée !");
            return $this->redirectToRoute("home");
        }
        return $this->render("talent/form.html.twig", [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }

    #[Route("/delete/skill/{id}", name: "delete_skill")]
    public function delete(Skill $skill, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->addFlash("danger", "La barre de talent '{$skill->getTitle()}' a été supprimée !");
        $em = $doctrine->getManager();
        $em->remove($skill);
        $em->flush();
        return $this->redirectToRoute("home");
    }

    #[Route("/update/skill/{id}", name: "update_skill")]
    public function update(Skill $skill, Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($skill); // À mettre à jour en BDD
            $doctrine->getManager()->flush();
            $this->addFlash("warning", "La barre de talent '{$skill->getTitle()}' a été modifiée !");
            return $this->redirectToRoute("home");
        }

        return $this->render("talent/form.html.twig", [
            "form" => $form->createView(),
            "skill" => $skill,
            "type" => "update",
        ]);
    }

    /* #[Route("/search", name: "search")]
    public function search(Request $request, ManagerRegistry $doctrine): Response
    {
        $search = $request->query->get('search');
        $tagRepository = $doctrine->getRepository(Tag::class);
        $tags = $tagRepository->findBySearch($search);
        $skillRepository = $doctrine->getRepository(Skill::class);
        $skills = $skillRepository->findBySearch($search);
        $projectRepository = $doctrine->getRepository(Project::class);
        $projects = $projectRepository->findBySearch($search);
        return $this->render("index.html.twig", ["talents" =>  $skills, "tags" =>  $tags, "projets" =>  $projects]);
    } */
}
