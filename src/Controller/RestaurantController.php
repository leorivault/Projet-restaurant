<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantController extends AbstractController

{

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

}