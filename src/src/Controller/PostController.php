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
    #[Route('/posts/', name: 'posts')]
    public function createPost(ManagerRegistry $doctrine): Response
    {   
/*        $test = $doctrine->getRepository(Post::class)->findOneBySomeField("price", 123  ); */        
        $test = $doctrine->getRepository(Post::class)->findAll();
        dd($test);

        return $this->render('posts/posts.html.twig'); 
    }
}
