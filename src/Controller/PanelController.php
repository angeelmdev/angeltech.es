<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PanelController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/panel', name: 'panel')]
    public function index(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
    
        // En caso de que se envie el formulario y sea valido
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('panel');
        }

        return $this->render('pages/panel/index.html.twig', [
            'controller_name' => 'PanelController',
            'form' => $form->createView()
        ]);
    }
}
