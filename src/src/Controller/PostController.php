<?php
// src/Controller/PostController.php
namespace App\Controller;

// ...
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController
{
   /*  #[Route('/post', name: 'post')]
    public function createPost(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $post = new Post();
        $post->setTitle('Air Jordan 1 Low');
        $post->setPrice(119);
        $post->setDescription("Toujours stylée, toujours tendance. Fidèle à l'histoire et à l'héritage de Jordan, la Air Jordan 1 Low vous offre un confort optimal tout au long de la journée. Choisissez vos couleurs et démarquez-vous grâce à sa silhouette emblématique conçue dans un mélange de matières haut de gamme et agrémentée d'une unité Air encapsulée au talon.");
        $post->setPublishedOn(date_create());
        $post->setUser("admin");

        // tell Doctrine you want to (eventually) save the post (no queries yet)
        $entityManager->persist($post);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new post with id '.$post->getId());
    } */
}