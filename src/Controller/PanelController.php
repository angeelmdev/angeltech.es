<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Form\ProjectType;
use App\Form\UserSettingsType;
use App\Service\ProjectService;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PanelController extends AbstractController
{
    public function __construct(
        private ProjectService $projectService,
        private UserService $userService
    ) {}

    #[Route('/panel', name: 'panel')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new \LogicException('Authentication error');
        }
        $projects = $this->projectService->list();

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $this->projectService->save($project);
            return $this->redirectToRoute('panel');
        }

        $settingsForm = $this->createForm(UserSettingsType::class, [
            'email' => $user->getEmail()
        ]);
        $settingsForm->handleRequest($request);

        if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
            try {
                $formData = $settingsForm->getData();
                
                // Llamar a UserService
                $this->userService->verifyCurrentPassword(
                    $user, 
                    $settingsForm->get('currentPassword')->getData()
                );
                
                $this->userService->checkEmailUniqueness($user, $formData['email']);
                
                $this->userService->updateSettings(
                    $user,
                    $formData['email'],
                    $settingsForm->get('plainPassword')->getData()
                );
                
                return $this->redirectToRoute('panel');
                
            } catch (\InvalidArgumentException $e) {
                $settingsForm->get('currentPassword')->addError(
                    new \Symfony\Component\Form\FormError($e->getMessage())
                );
            }
        }

        return $this->render('pages/panel/index.html.twig', [
            'form' => $form->createView(),
            'settingsForm' => $settingsForm->createView(),
            'projects' => $projects
        ]);
    }
}
