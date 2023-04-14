<?php

namespace App\Controller\Car;

use App\Entity\Car;
use App\Form\CarFormType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateCarController extends AbstractController
{
    #[Route('/dashboard/car/create', name: 'app_create_car')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarFormType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form['imageFile']->getData();

            /** Upload car image */
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('cars_images_dir'),
                    $newFilename
                );
                $car->setImage($newFilename);
            }

            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash('success', 'Car added !');
            return $this->redirectToRoute('app_listing_car');
        }

        return $this->render('dashboard/car/create.html.twig', [
            'carForm' => $form->createView(),
        ]);
    }
}