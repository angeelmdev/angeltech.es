<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PanelController extends AbstractController
{
    #[Route('/panel', name: 'app_panel')]
    public function index(): Response
    {
        return $this->render('pages/panel/index.html.twig', [
            'controller_name' => 'PanelController',
        ]);
    }
}
