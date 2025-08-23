<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService
    ){}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $projects = $this->projectService->list();

        return $this->render('pages/home/index.html.twig', [
            'projects' => $projects
        ]);
    }
}
