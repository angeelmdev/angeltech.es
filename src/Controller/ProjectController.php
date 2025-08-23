<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ProjectController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService
    ) {}

    #[Route('/api/projects', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['title'], $data['description'])) {
            return $this->json(['error' => 'Los campos title y description son obligatorios'], 400);
        }

        $project = new Project();
        $project->setTitle($data['title']);
        $project->setDescription($data['description']);
        $project->setUrl($data['url'] ?? null);
        $project->setUrlGithub($data['url_github'] ?? null);

        $this->projectService->save($project);

        return $this->json([
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'url' => $project->getUrl(),
            'url_github' => $project->getUrlGithub()
        ], 201);
    }

    #[Route('/api/projects', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $projects = $this->projectService->list();

        $data = array_map(fn(Project $project) => [
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'url' => $project->getUrl(),
            'url_github' => $project->getUrlGithub(),
        ], $projects);

        return $this->json($data);
    }

    #[Route('/api/projects/{id}', name: 'project_delete', methods: ['DELETE'])]
    public function delete(Project $project): JsonResponse
    {
        if (!$project) {
            return $this->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $this->projectService->delete($project);

        return $this->json(['message' => 'Proyecto eliminado correctamente'], 200);
    }
}
