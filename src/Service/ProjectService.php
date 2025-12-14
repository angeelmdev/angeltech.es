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
        $isNew = $project->getId() === null;

        $this->em->persist($project);
        $this->em->flush();

        if ($isNew && $project->getPosition() === null) {
            $project->setPosition($project->getId());
            $this->em->flush();
        }

        return $project;
    }

    public function list(): array
    {
        return $this->projectRepository->findAllOrderedByPosition();
    }

    public function swapPositions(Project $project1, Project $project2): void
    {
        $pos1 = $project1->getPosition();
        $pos2 = $project2->getPosition();

        $project1->setPosition($pos2);
        $project2->setPosition($pos1);

        $this->em->flush();
    }

    public function delete(Project $project): void
    {
        $this->em->remove($project);
        $this->em->flush();
    }
}
