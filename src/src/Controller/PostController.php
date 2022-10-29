<?php
// src/Controller/PostController.php
namespace App\Controller;

// ...

use App\Entity\Post;
use App\Form\PostType;
use App\Entity\PicturePost;
use App\Form\SearchFormType;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/search-post', name: 'search_posts')]

    public function searchPost(Request $request, PostRepository $PostRepository, TagRepository $TagRepository){
        $posts = [];
        $tags = 0;
        $searchPostForm = $this->createForm(SearchFormType::class);

        if($searchPostForm->handleRequest($request)->isSubmitted() && $searchPostForm->isValid()){
            $criteria = $searchPostForm->getData();
            $tags = $TagRepository->searchTag($criteria['tag_id']);
            if(isset($tags[0])){
                dump($tags[0]->getId());
                $criteria['tag_id'] = $tags[0]->getId();
            }else{
                $criteria['tag_id'] = '';
            }
            $posts = $PostRepository->searchPost($criteria);

        }
        return $this->render('search/post.html.twig', [
            'form_search' => $searchPostForm->createView(),
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}', name: 'app_post_one')]
    public function showPost(Post $post): Response
    {
        return $this->render('posts/post.html.twig', [
            'post' => $post
        ]);
    }

    #[Route('/create-post', name: 'app_create_post')]
    public function create(Request $request, EntityManagerInterface $manager, UserInterface $user): Response
    {
        $form_create = $this->createForm(PostType::class);

        $form_create->handleRequest($request);

        if($form_create->isSubmitted() && $form_create->isValid()){
            $post = new Post();
            $post = $form_create->getData();
            $post->setPublishedOn(new \DateTime());
            $post->setUser($this->getUser());
            $manager->persist($post);
            $manager->flush();

            $this->addFlash(
                'notice',
                'Super ! Un nouveau post'
            );

            return $this->redirectToRoute('posts');
        }

        return $this->render('posts/create.html.twig', [
            'form_create' => $form_create ->createView()
        ]);
    }

    #[Route('/update-post/{id}', name: 'app_update_post')]
    public function update(Request $request, EntityManagerInterface $entityManager, Post $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(PostType::class, $post);
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
