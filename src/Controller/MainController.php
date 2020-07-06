<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Form\RemoveCarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/remove", name="remove")
     */
    public function successPage()
    {
        return $this->render('main/remove_successed.html.twig');
    }

    /**
     * @Route("/success", name="success")
     */
    public function removeSuccessPage()
    {
        return $this->render('main/success.html.twig');
    }

    /**
     * @Route("/remove/failed", name="remove_failed")
     */
    public function removeFailedPage()
    {
        return $this->render('main/remove_failed.html.twig');
    }

    /**
     * @Route("/remove/success", name="remove_successed")
     */
    public function removeSuccessedPage()
    {
        return $this->render('main/remove_successed.html.twig');
    }

    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request)
    {
        $createForm = $this->createForm(CarType::class);
        $removeForm = $this->createForm(RemoveCarType::class);

        $createForm->handleRequest($request);

        if($createForm->isSubmitted())
        {
            $car = $createForm->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();
            //var_dump($car);
            //var_dump("gites dodano do bazy");
            return $this->redirectToRoute('success');
        }

        $removeForm->handleRequest($request);

        if ($removeForm->isSubmitted())
        {
            $car = $removeForm->getData();

            $carId = $car["id"];

            $searchedCar = $this->getDoctrine()->getRepository(Car::class)->find($carId);

            if(!$searchedCar)
            {
                return $this->redirectToRoute('remove_failed', [
                ]);
            }
            else
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($searchedCar);
                $entityManager->flush();

                return $this->redirectToRoute('remove_successed');
            }
        }

        return $this->render('main/index.html.twig', [
            'form' => $createForm->createView(),
            'removeForm' => $removeForm->createView(),
        ]);
    }
}
