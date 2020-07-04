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
        return $this->render('main/remove_success.html.twig');
    }

    /**
     * @Route("/success", name="success")
     */
    public function removeSuccessPage()
    {
        return $this->render('main/remove_success.html.twig');
    }

    /**
     * @Route("/main", name="main")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(CarType::class);
        $removeForm = $this->createForm(RemoveCarType::class);

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
        if($removeForm->isSubmitted())
        {
            $id = $removeForm->getData();

            $entityManager = $this->getDoctrine()->getManager();

            //$entityManager->flush();
            var_dump($id);
            //var_dump("gites dodano do bazy");
            return $this->redirectToRoute('remove');
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'removeForm' => $removeForm->createView(),
        ]);
    }
}
