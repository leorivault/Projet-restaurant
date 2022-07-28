<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantController extends AbstractController

{

    //tableau de bord des restaurant
    #[Route('/restaurant', 'restaurant.index', methods: ['GET'])]
    public function index(RestaurantRepository $repository): Response {

        $restaurants = $repository->findAll();

        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);

    }

    //ajout d'un restaurant
    #[Route('/restaurant/add', name: 'restaurant.add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $restaurant = $form->getData();

            $manager->persist($restaurant);
            $manager->flush();

            return $this->redirectToRoute('home.index');
        }

        return $this->render('restaurant/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

        //on peut passer directement l'objet en parametre pour recupérer, plus besoin de faire l'ancienne méthode
        /* $ingredient = $repository->findOneBy(["id" => $id]); */
        /* IngredientRepository $repository, int $id */
    
    //modification d'un restaurant
    #[Route('/restaurant/edit/{id}', name: 'restaurant.edit', methods: ['GET', 'POST'])]
    public function edit(Restaurant $restaurant, Request $request, EntityManagerInterface $manager) : Response 
    {
    
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $restaurant = $form->getData();

            $manager->persist($restaurant);
            $manager->flush();

            return $this->redirectToRoute('restaurant.index');
        }

        return $this->render('restaurant/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/restaurant/delete/{id}', name: 'restaurant.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Restaurant $restaurant) : Response
    {

        $manager->remove($restaurant);
        $manager->flush();

        return $this->redirectToRoute('restaurant.index');
    }

}