<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Title
            ->add('title', TextType::class, [
                // Label
                'label' => "Titre du livre",
                'label_attr' => [
                    'class' => "form-label-test",
                ],

                // Make it required
                'required' => true,

                // Attribute
                'attr' => [
                    'placeholder' => "Saisir le titre du livre",
                ],

                // Helper
                'help' => "Ajouter le titre du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Constraints 
                'constraints' => [
                    new NotBlank([
                        'message' => "Le titre du livre est obligatoire",
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => "Le titre ne peux contenir que {{ limit }} caractères"
                    ]),
                ],
            ])

            // Description
            ->add('description', TextareaType::class, [
                // Label
                'label' => "Description du livre",
                

                // Make it required
                'required' => false,

                // Attribute
                'attr' => [
                    'placeholder' => "Saisir la description du livre",
                ],

                // Helper
                'help' => "Ajouter la description du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Constraints 
            ])

            // Cover
            ->add('cover', FileType::class, [
                // Label
                'label' => "Couverture du livre",
                

                // Make it required
                'required' => false,

                // Attribute
                'attr' => [
                    'multiple' => true,
                ],

                // Helper
                'help' => "Ajouter la couverture du livre",
                'help_attr' => [
                    'class' => "text-muted",
                ],

                // Constraints 
                'constraints' => [
                    new Image([
                        'mimeTypes'=> [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => "Format accepter: {{ type }}.",
                        'maxSize' => "2M",
                        'maxSizeMessage'=> "La taille du fichier ne doit pas dépasser {{ limit }}{{ suffix }}"
                    ]),

                    new Length([
                        'max' => 180,
                        'maxMessage' => "Le titre ne peux contenir que {{ limit }} caractères."
                    ]),
                ],
            ])

            // Price
            ->add('price', NumberType::class, [
                    // Label
                    'label' => "Prix du livre",
                    'label_attr' => [
                        'class' => "form-label-test",
                    ],
    
                    // Make it required
                    'required' => false,
    
                    // Attribute
                    'attr' => [
                        'placeholder' => "Saisir le prix du livre",
                        'step'=>"0.01",
                        'min'=>"0.00",
                    ],
    
                    // Helper
                    'help' => "Ajouter le prix du livre",
                    'help_attr' => [
                        'class' => "text-muted",
                    ],
    
                    // Constraints 
                    'constraints' => [
                        new GreaterThan([
                            'value' => 0,
                            'message' => "Le prix doit être superieur à {{ value }}"
                        ])
                    ],
                    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
