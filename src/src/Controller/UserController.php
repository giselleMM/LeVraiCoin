<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    #[Route('/user/upvote/{id}', name: 'app_user_upvote')]
    public function upVoteUser(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $note = $user->getPositiveNote();
        $user->setPositiveNote($note+1);
        $entityManager->flush();

        dd($user);
        /*
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
        */
    }

    #[Route('/user/downvote/{id}', name: 'app_user_downvote')]
    public function downVoteUser(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        //rajouter le nombre de vote total
        //$user->setTotalVote($user->getTotalVote()+1);
        $note = $user->getNegativeNote();
        $user->setNegativeNote($note+1);
        $entityManager->flush();

        dd($user);
        /*
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
        */
    }
}
