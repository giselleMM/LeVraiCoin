<?php
// src/Controller/PostController.php
namespace App\Controller;

// ...

use App\Entity\PicturePost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController
{
    #[Route('/', name: 'posts')]
    public function createPost(ManagerRegistry $doctrine): Response
    {   
        $posts = $doctrine->getRepository(Post::class)->findAll();
        return $this->render('posts/posts.html.twig', [
            'posts' => $posts
        ]); 
    }
}
