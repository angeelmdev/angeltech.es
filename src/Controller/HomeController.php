<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $projects = [
            [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 1',
                'description' => 'Descripción breve del proyecto 1'
            ],
            [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 2',
                'description' => 'Descripción breve del proyecto 2'
            ],
            [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 3',
                'description' => 'Descripción breve del proyecto 3'
            ],
                        [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 4',
                'description' => 'Descripción breve del proyecto 1'
            ],
            [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 5',
                'description' => 'Descripción breve del proyecto 2'
            ],
            [
                'image' => '/images/cat.jpg',
                'title' => 'Proyecto 6',
                'description' => 'Descripción breve del proyecto 3'
            ],
        ];

        return $this->render('pages/home/index.html.twig', [
            'projects' => $projects
        ]);
    }
}
