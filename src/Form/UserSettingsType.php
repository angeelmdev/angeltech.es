<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Contraseña actual',
                'mapped' => false,
                'attr' => [
                    'class' => 'block mb-4 w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-white text-sm focus:ring-blue-500 focus:border-blue-500',
                    'placeholder' => 'Introduce tu contraseña actual'
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'La contraseña actual es obligatoria para realizar cambios.'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
                'attr' => [
                    'class' => 'block mb-4 w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-white text-sm focus:ring-blue-500 focus:border-blue-500',
                    'maxlength' => 180
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'El correo electrónico es obligatorio.'
                    ]),
                    new Assert\Email([
                        'message' => 'El correo electrónico no es válido.'
                    ]),
                    new Assert\Length([
                        'max' => 180,
                        'maxMessage' => 'El correo no puede superar {{ limit }} caracteres.'
                    ])
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => false,
                'first_options' => [
                    'label' => 'Nueva contraseña',
                    'attr' => [
                        'class' => 'block mb-4 w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-white text-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Nueva contraseña'
                    ],
                    'label_attr' => [
                        'class' => 'block mb-2 text-sm font-medium text-gray-900'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmar nueva contraseña',
                    'attr' => [
                        'class' => 'block mb-8 w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-white text-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Confirmar contraseña'
                    ],
                    'label_attr' => [
                        'class' => 'block mb-2 text-sm font-medium text-gray-900'
                    ]
                ],
                'invalid_message' => 'Las contraseñas no coinciden.',
                'constraints' => [
                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres.'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
