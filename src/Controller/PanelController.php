<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Service\ProjectService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PanelController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService
    ) {}

    #[Route('/panel', name: 'panel')]
    public function index(Request $request): Response
    {
        $projects = $this->projectService->list();

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $this->projectService->save($project);
            return $this->redirectToRoute('panel');
        }

        return $this->render('pages/panel/index.html.twig', [
            'form' => $form->createView(),
            'projects' => $projects
        ]);
    }
}
