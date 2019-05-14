<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index(): Response
    {
        return $this->render('blog/blog.html.twig', [
            'owner' => 'Manoa',
        ]);
    }
    /**
     * @Route("blog/show/{slug}", requirements={"slug"="[a-z]+"})
     */
    public function show(string $slug = "article sans titre"): Response
    {
        return $this->render('blog/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
        ]);
    }
}
