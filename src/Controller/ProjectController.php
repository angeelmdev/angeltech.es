<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProjectRepository;

final class ProjectController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository
    ) {}

    #[Route('/api/projects', methods: ['POST'])]
    public function create(
        Request $request
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['title'], $data['description'])) {
            return $this->json(['error' => 'Los campos title y description son obligatorios'], 400);
        }

        $project = new Project();
        
        $project->setTitle($data['title']);
        $project->setDescription($data['description']);

        if (!isset($data['url'], $data['url_github'])) {
            $project->setUrl($data['url']);
            $project->setUrlGithub($data['url_github']);
        }

        $this->em->persist($project);
        $this->em->flush();

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
        $projects = $this->projectRepository->findAll();

        $data = array_map(fn(Project $project) => [
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'description' => $project->getDescription(),
            'url' => $project->getUrl(),
            'url_github' => $project->getUrlGithub(),
        ], $projects);

        return $this->json($data);
    }

    #[Route('/api/projects/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $project = $this->projectRepository->find($id);

        if (!$project) {
            return $this->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $this->em->remove($project);
        $this->em->flush();

        return $this->json(['message' => 'Proyecto eliminado correctamente'], 200);
    }
}
