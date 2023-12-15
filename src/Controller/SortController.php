<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Project;

/**
 * The SortController class handles sorting operations in the application.
 */
class SortController extends AbstractController
{
    private $entityManager;

    /**
     * Constructs a new SortController instance.
     *
     * @param EntityManagerInterface $entityManager The entity manager to use for database operations.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/sort/{order}", name: "sort")]
    public function sort(string $order): Response
    {
        $projectRepo = $this->entityManager->getRepository(Project::class);

        if ($order === 'titleAsc') {
            $projects = $projectRepo->findBy([], ['title' => 'ASC']);
        } elseif ($order === 'titleDesc') {
            $projects = $projectRepo->findBy([], ['title' => 'DESC']);
        } elseif ($order === 'dateAsc') {
            $projects = $projectRepo->findBy([], ['date' => 'ASC']);
        } elseif ($order === 'dateDesc') {
            $projects = $projectRepo->findBy([], ['date' => 'DESC']);
        } else {
            throw $this->createNotFoundException('Invalid sort order');
        }

        return $this->render('index.html.twig', ['projects' => $projects]);
    }
}
