<?php

namespace App\Service;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProjectRepository;

class ProjectService
{
    public function __construct(
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository
    ) {}

    public function save(Project $project): Project
    {
        $this->em->persist($project);
        $this->em->flush();

        return $project;
    }

    public function list(): array
    {
        return $this->projectRepository->findAll();
    }

    public function delete(Project $project): void
    {
        $this->em->remove($project);
        $this->em->flush();
    }
}
