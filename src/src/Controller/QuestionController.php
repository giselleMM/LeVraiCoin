<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Question;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    
}
