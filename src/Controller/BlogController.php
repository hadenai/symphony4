<?php


namespace App\Controller;



use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends AbstractController
{
    /**
     *  Show all row from article's entity
     * @Route("/blog", name="blog_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
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
    /**
     * @Route("/category/{categoryName}", name="show_category")
     */
    public function showByCategory(string $categoryName): Response
    {
        // récuperer une category avec findOneBy
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category], array('id' => 'desc'), 3);        // Tri
        return $this->render(
            'blog/category.html.twig',
            [
                'article' => $article,
                'category' => $category,
            ]
        );
        // récuperer les articles de cette categorie avec findBy
        // limite de 3 articles et un tri par id décroissant
        //retourner dans une vue
    }

}


