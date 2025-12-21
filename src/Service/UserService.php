<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function verifyCurrentPassword(User $user, string $currentPassword): void
    {
        if (!$this->passwordHasher->isPasswordValid($user, $currentPassword)) {
            throw new \InvalidArgumentException('La contraseña actual no es correcta.');
        }
    }

    public function checkEmailUniqueness(User $currentUser, string $newEmail): void
    {
        if ($currentUser->getEmail() === $newEmail) {
            return;
        }

        $existingUser = $this->userRepository->findOneBy(['email' => $newEmail]);
        
        if ($existingUser !== null) {
            throw new \InvalidArgumentException('Este correo electrónico ya está en uso.');
        }
    }

    public function updateSettings(User $user, string $newEmail, ?string $newPassword = null): User
    {
        $user->setEmail($newEmail);

        if ($newPassword !== null && $newPassword !== '') {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);
        }

        $this->em->flush();
        return $user;
    }
}