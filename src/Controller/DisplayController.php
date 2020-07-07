<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\RemoveCarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    /**
     * @Route("/display", name="display")
     */
    public function index()
    {
        return $this->render('display/display.html.twig', [
           'allCars' => $allCars = $this->displayCars(),
        ]);
    }

    public function displayCars()
    {
        $repository = $this->getDoctrine()->getRepository(Car::class);
        return $repository->findAll();
    }
}
