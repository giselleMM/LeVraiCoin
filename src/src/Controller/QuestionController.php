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
            "T'as demandé à Joe ?",
            "C'est qui Joe ?",
            "He he he ...",
            "don't care + didn't ask + you're white + cry about it + stay mad + get real + L + mald seethe cope harder + hoes mad + basic + skill issue + ratio + you fell off + the audacity + triggered + any askers + redpilled + get a life + ok and? + cringe + touch grass + donowalled + not based + your're a (insert stereotype) + not funny didn't laugh + you're* + grammar issue + go outside + get good + reported + ad hominem + GG! + ask deez + ez clap + straight cash + ratio again + final ratio + stay mad + stay pressed + pedophile + cancelled + done for + mad free + freer than air + rip bozo + slight_smile + cringe again + mad cuz bad + lol + irrelevant + cope + jealous + go ahead whine about it + your problem + don't care even more + sex offender + sex defender + not okay + glhf + problematic "
        ];
        

        return $this->render('question/show.html.twig',[
            'question' => sprintf('La question posée est : %s', $ma_wildcard),
            'answers' => $answers
        ]); 
    }

    
}
