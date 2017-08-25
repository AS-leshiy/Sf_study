<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 *
 */

class AdminPanelController extends Controller
{
    /**
     * @Route("/list", name="adminPanel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        return $this->render('admin/admin.html.twig', ['posts' => $posts]);
    }
    
    /**
     * @Route("/addnew", name="adminPanel_addnew")
     * @Method({"GET", "POST"})
     */
    public function addnewAction(Request $request){
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
            $this->addFlash('success', 'post.created_successfully');
            
            return $this->redirectToRoute('adminPanel_index');
        }
        
        return $this->render('admin/add.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}/delete", requirements={"id": "\d+"}, name="adminPanel_delete")
     * @Security("is_granted('delete', post)")
     * @Method("GET")
     */
    public function deleteAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('adminPanel_index');
    }
    
    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, name="adminPanel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Post $post)
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminPanel_index');
        }

        return $this->render('admin/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
