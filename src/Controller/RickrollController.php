<?php /* Controller pour l'easteregg Rickroll */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RickrollController extends AbstractController
{
    #[Route("/rickroll", name:"rickroll")]
    public function FunctionName(): Response{
        return $this->render('rickroll.html.twig');
    }
}