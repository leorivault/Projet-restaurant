<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType as TypeEntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //création du formulaire
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('insee', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'INSEE',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            //select de la categorie
            ->add('categorie', TypeEntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            //bouton submit
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
                'label' => 'Créer mon ingrédient',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
