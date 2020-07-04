<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/success", name="success")
     */
    public function successPage()
    {
        return $this->render('main/success.html.twig');
    }

    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(CarType::class);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $car = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();
            //var_dump($car);
            //var_dump("gites dodano do bazy");
            return $this->redirectToRoute('success');
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
