<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    #[Route("/read/{id}", name: "read_tag")]
    public function read(tag $tag): Response
    {
        if (!$tag) {
            throw $this->createNotFoundException();
        }
        return $this->render("tag/readTag.html.twig", ["tag" => $tag]);
    }

    
    #[Route("/createTag", name: "create_tag")]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($tag);
            $em->flush();
            $this->addFlash("success", "Le tag '{$tag->getTitle()}' a été créée !");
            return $this->redirectToRoute("home");
        }
        return $this->render("tag/form.html.twig", [
            "form" => $form->createView(),
            "type" => "create",
        ]);
    }

    #[Route("/delete/tag/{id}", name: "delete_tag")]
    public function delete(Tag $tag, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $this->addFlash("danger", "Le tag '{$tag->getTitle()}' a été supprimée !");
        $em = $doctrine->getManager();
        $em->remove($tag);
        $em->flush();
        return $this->redirectToRoute("home");
    }

    #[Route("/update/tag/{id}", name: "update_tag")]
    public function update(Tag $tag, Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($skill); // À mettre à jour en BDD
            $doctrine->getManager()->flush();
            $this->addFlash("warning", "Le tag '{$tag->getTitle()}' a été modifiée !");
            return $this->redirectToRoute("home");
        }

        return $this->render("tag/form.html.twig", [
            "form" => $form->createView(),
            "tag" => $tag,
            "type" => "update",
        ]);
    }
}
