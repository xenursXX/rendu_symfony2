<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->findAll();

        return $this->render('AppBundle:Article:index.html.twig', [
            'article' => $article,
        ]);
    }
    /**
     * Creates a new Article entity.
     *
     * @Route("/create", name="article_create")
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $article->getId())));
        }

        return $this->render('AppBundle:Article:new.html.twig', [
            'article' => $article,
            'form'   => $form->createView(),
        ]);
    }


    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article->getId());

        return $this->render('AppBundle:Article:show.html.twig', [
            'article'      => $article,
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method("PUT|GET")
     * @Template("AppBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($article->getId());

        $editForm = $this->createForm(new ArticleType(), $article, array(
            'action' => $this->generateUrl('article_edit', array('id' => $article->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('article'));
        }

        return $this->render('AppBundle:Article:edit.html.twig', [
            'article'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);





    }






    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
