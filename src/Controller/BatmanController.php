<?php /* Controller pour l'easteregg Batman=Chris */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatmanController extends AbstractController
{
    #[Route("/batman", name:"batman")]
    public function FunctionName(): Response{
        return $this->render('batman.html.twig');
    }
}