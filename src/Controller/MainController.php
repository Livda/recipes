<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function homepage(): Response
    {
        return $this->redirectToRoute('app_recipe_index');
    }
}
