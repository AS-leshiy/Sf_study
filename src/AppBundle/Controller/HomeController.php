<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 *
 * @Route("/")
 *
 */

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        return $this->render('home/home.html.twig', ['posts' => $posts]);
    }
    
    /**
     * @Route("/posts/{slug}/show", name="home_article")
     * @ParamConverter("post", class="AppBundle:Post", options={"id" = "slug"})
     * @Method("GET")
     */
    public function showAction(Post $post)
    {
        return $this->render('home/post_show.html.twig', ['post' => $post]);
    }
}
