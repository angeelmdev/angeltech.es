<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Título del proyecto',
                'attr' => [
                    'class' => 'block mb-4 w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-white text-sm focus:ring-blue-500 focus:border-blue-500'
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descripción del proyecto',
                'attr' => [
                    'class' => 'block mb-4 w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-white text-base focus:ring-blue-500 focus:border-blue-500',
                    'rows' => 4
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
            ])
            ->add('url_github', null, [
                'label' => 'URL Github',
                'attr' => [
                    'class' => 'block mb-4 w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500'
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
            ])
            ->add('url', null, [
                'label' => 'URL Demo',
                'attr' => [
                    'class' => 'block mb-6 w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500'
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
            ])
            ->add('image', null, [
                'label' => 'Upload file',
                'attr' => [
                    'class' => 'block w-full cursor-pointer focus:outline-none text-gray-900 border border-gray-300 rounded-lg bg-white text-xs focus:ring-blue-500 focus:border-blue-500'
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-gray-900'
                ],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
