<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    #[Route("/", name: "home")]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Skill::class);
        $skills = $repo->findAll();
        return $this->render("talent/home.html.twig", ["talents" =>  $skills]);
    }

    #[Route("/read/{id}", name: "read")]
    public function read(Skill $skill): Response
    {
        if (!$skill) {
            throw $this->createNotFoundException();
        }
        return $this->render("talent/readTalent.html.twig", ["talent" => $skill]);
    }

    
    #[Route("/createTalent", name: "createTalent")]
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

    #[Route("/delete/{id}", name: "delete")]
    public function delete(Skill $skill, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->addFlash("danger", "La barre de talent '{$skill->getTitle()}' a été supprimée !");
        $em = $doctrine->getManager();
        $em->remove($skill);
        $em->flush();
        return $this->redirectToRoute("home");
    }

    #[Route("/update/{id}", name: "update")]
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
}
