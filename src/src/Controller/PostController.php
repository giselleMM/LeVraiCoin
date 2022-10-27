<?php
// src/Controller/PostController.php
namespace App\Controller;

// ...

use App\Entity\PicturePost;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController
{
    #[Route('/', name: 'posts')]
    public function getAll(ManagerRegistry $doctrine): Response
    {   
        $posts = $doctrine->getRepository(Post::class)->findAll();
        return $this->render('posts/posts.html.twig', [
            'posts' => $posts
        ]); 
    }

    #[Route('/post/{id}', name: 'app_post_one')]
    public function showPost(EntityManagerInterface $entityManager, Post $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->findOneBy(['id' => $id]);
        dd($post);
        /*
          return $this->render('posts/posts.html.twig', [
            'post' => $post
        ]);
         */
    }

    #[Route('/create-post', name: 'app_create_post')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        //Récupératiopn de l'id post et l'id user. Si possible, le front envoi une requête avec les données du form et les différents id needed
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('posts');
        }
        dd($form);
        /*
        return $this->render('/post.html.twig', [
            'postForm' => $form->createView(),
        ]);*/
    }

    #[Route('/update-post/{id}', name: 'app_update_post')]
    public function update(Request $request, EntityManagerInterface $entityManager, Post $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('posts');
        }
        dd($form);
        /*
         * Renvoi du formulaire avec en param l'objet post pour l'autocomplétion des champs du formulaire
        return $this->render('/post.html.twig', [
            'postForm' => $form->createView(),
            'post' => $post
        ]);*/
    }

    #[Route('/delete-post/{id}', name: 'app_delete_post')]
    public function delete(EntityManagerInterface $entityManager, Post $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->findOneBy(['id' => $id]);
        if (!$post) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $entityManager->remove($post);
        $entityManager->flush();
        return $this->redirectToRoute("posts");
    }

}
