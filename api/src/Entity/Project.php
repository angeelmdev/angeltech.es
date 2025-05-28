<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isAngular = null;

    #[ORM\Column]
    private ?bool $isNode = null;

    #[ORM\Column]
    private ?bool $isSymfony = null;

    #[ORM\Column]
    private ?bool $isBootstrap = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isAngular(): ?bool
    {
        return $this->isAngular;
    }

    public function setIsAngular(bool $isAngular): static
    {
        $this->isAngular = $isAngular;

        return $this;
    }

    public function isNode(): ?bool
    {
        return $this->isNode;
    }

    public function setIsNode(bool $isNode): static
    {
        $this->isNode = $isNode;

        return $this;
    }

    public function isSymfony(): ?bool
    {
        return $this->isSymfony;
    }

    public function setIsSymfony(bool $isSymfony): static
    {
        $this->isSymfony = $isSymfony;

        return $this;
    }

    public function isBootstrap(): ?bool
    {
        return $this->isBootstrap;
    }

    public function setIsBootstrap(bool $isBootstrap): static
    {
        $this->isBootstrap = $isBootstrap;

        return $this;
    }
}
