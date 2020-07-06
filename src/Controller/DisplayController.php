<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    /**
     * @Route("/display", name="display")
     */
    public function index()
    {
        $allCars = $this->displayCars();
        return $this->render('display/display.html.twig', [
           'allCars' => $allCars,
        ]);
    }

    public function displayCars()
    {
        $repository = $this->getDoctrine()->getRepository(Car::class);
        $allCars = $repository->findAll();
        return $allCars;
    }
}
