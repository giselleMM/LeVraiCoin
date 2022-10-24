<?php

// src/Controller/TestController.php
namespace App\Controller;

// ...
use App\Entity\Test;
use App\Form\TestType;
use App\Entity\PropertySearch;

use App\Form\PropertySearchType;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function createtest(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $test = new Test();
        $test->setTitle('Air Jordan 1 Low');
        $test->setPrice(119);
        $test->setDescription("Toujours stylée, toujours tendance. Fidèle à l'histoire et à l'héritage de Jordan, la Air Jordan 1 Low vous offre un confort optimal tout au long de la journée. Choisissez vos couleurs et démarquez-vous grâce à sa silhouette emblématique conçue dans un mélange de matières haut de gamme et agrémentée d'une unité Air encapsulée au talon.");
        $test->setPublishedOn(date_create());
        $test->setUserId(1);

        // tell Doctrine you want to (eventually) save the test (no queries yet)
        $entityManager->persist($test);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new test with id '.$test->getId());
    }



    #[Route('/test/{id}', name: 'test_show')]
    public function show(EntityManagerInterface $doctrine, int $id): Response
    {
        $test = $doctrine->getRepository(Test::class)->find($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No test found for id '.$id
            );
        }

        return $this->render('test/show.html.twig', ['test' => $test]);

        // or render a template
        // in the template, print things with {{ test.name }}
        // return $this->render('test/show.html.twig', ['test' => $test]);
    }


    #[Route('/test2', name: 'test_test')]

    public function add(EntityManagerInterface $manager, Request $request){
        $form = $this->createForm(TestType::class);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $test = $form->getData();
            $manager->persist($test);
            $manager->flush();

            $this->addFlash(
                'notice',
                'Super ! Un nouveau test a été ajoutée !'
            );

            return $this->redirectToRoute('/test/search');
        }
        return  $this->render('test/test.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/index', name: 'test_index')]

    public function index(TestRepository $testRepository){
        $tests = $testRepository->findAll();

        return $this->render('test/index.html.twig', [
            'tests' => $tests,
        ]);
    }
}