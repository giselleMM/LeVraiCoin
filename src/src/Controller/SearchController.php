<?php

namespace App\Controller;

use App\Form\SearchTestType;
use App\Repository\TestRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/test/search', name: 'test_search')]

    public function searchTest(Request $request, TestRepository $testRepository){

        $tests = [];
        $searchTestForm = $this->createForm(SearchTestType::class);

        if($searchTestForm->handleRequest($request)->isSubmitted() && $searchTestForm->isValid()){
            $criteria = $searchTestForm->getData();
            $tests = $testRepository->searchTest($criteria);

        }
        return $this->render('search/test.html.twig', [
            'form_search' => $searchTestForm->createView(),
            'tests' => $tests,
        ]);
    }
}