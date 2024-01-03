<?php /* Controller pour la gestion des utilisateurs */

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController /* Pas utiliser car il existe que 1 seul admin */
{
    #[Route('/user/create', name: 'user_create')] // Création d'un utilisateur
    public function create(Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new User($passwordHasher);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render("user/form.html.twig", [
            "form" => $form->createView()
        ]);
    }
}