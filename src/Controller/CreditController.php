<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditController extends AbstractController
{
    #[Route("/credit", name:"credit")]
    public function FunctionName(): Response{
        return $this->render('credit.html.twig');
    }
}