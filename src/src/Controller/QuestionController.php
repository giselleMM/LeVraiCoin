<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerFormType;
use App\Form\QuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController 
{   
    /**
     * @Route("/questions/{ma_wildcard}")
     */
    
    public function show($ma_wildcard){

        $answers= [
               ];
        

        return $this->render('question/show.html.twig',[
            'question' => sprintf('La question posée est : %s', $ma_wildcard),
            'answers' => $answers
        ]); 
    }

    #[Route('/question/{id}', name: 'app_question_one')]
    public function showQuestion(Question $id, Request $request, EntityManagerInterface $manager,ManagerRegistry $doctrine): Response
    {
        $question = $manager->getRepository(Question::class)->findOneBy(['id' => $id]);

        $answers = $doctrine->getRepository(Answer::class)->findByQuestion($question);

        $form_answer = $this->createForm(AnswerFormType::class);

        $form_answer->handleRequest($request);


        if($form_answer->isSubmitted() && $form_answer->isValid()){
            $answer = new Answer();
            $answer = $form_answer->getData();
            $answer->setAuthor($this->getUser());
            $answer->setQuestion($question);
            $manager->persist($answer);
            $manager->flush();

            $this->addFlash(
                'notice',
                'Super ! Une nouvelle answer'
            );
            return $this->redirect($request->getUri());
        }
        

        return $this->render('question/question.html.twig', [
            'question' => $question,
            'answers' => $answers,
            'form_answer' => $form_answer->createView()
        ]);
        
        
    }

    
}
