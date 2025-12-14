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

    #[Route('/api/projects/{id}/move', name: 'project_move', methods: ['POST'])]
    public function move(Project $project, Request $request): JsonResponse
    {
        if (!$project) {
            return $this->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $data = json_decode($request->getContent(), true);
        $direction = $data['direction'] ?? null;

        if (!in_array($direction, ['left', 'right'])) {
            return $this->json(['error' => 'Dirección inválida. Use "left" o "right"'], 400);
        }

        $projects = $this->projectService->list();

        $currentIndex = null;
        foreach ($projects as $index => $p) {
            if ($p->getId() === $project->getId()) {
                $currentIndex = $index;
                break;
            }
        }

        if ($currentIndex === null) {
            return $this->json(['error' => 'Proyecto no encontrado en la lista'], 404);
        }

        $targetIndex = $direction === 'left' ? $currentIndex - 1 : $currentIndex + 1;

        if ($targetIndex < 0 || $targetIndex >= count($projects)) {
            return $this->json(['message' => 'No se puede mover en esa dirección'], 200);
        }

        $this->projectService->swapPositions($project, $projects[$targetIndex]);

        return $this->json(['message' => 'Proyecto movido correctamente'], 200);
    }
}
